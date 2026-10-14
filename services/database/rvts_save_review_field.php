
<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class rvts_save_review_field {

    public function save(
        int $review_id,
        string $field_id,
        string $field_type,

        /**
         * @param mixed $field_value
         */
        mixed $field_value,
        int $max_stars = 0
    ) {

        global $wpdb;

        $table = $wpdb->prefix . 'rvts_review_fields';

        if ( is_array( $field_value ) ) {
            $field_value = wp_json_encode( $field_value );
        }

        $data = [
            'review_id'   => $review_id,
            'field_id'    => sanitize_key( $field_id ),
            'field_type'  => sanitize_key( $field_type ),
            'field_value' => $field_value,
            'max_stars'   => (
                'rating' === $field_type
            ) ? max( 0, $max_stars ) : 0,
        ];

        $formats = [
            '%d',
            '%s',
            '%s',
            '%s',
            '%d',
        ];

        $inserted = $wpdb->insert(
            $table,
            $data,
            $formats
        );

        if ( false === $inserted ) {
            return new WP_Error(
                'review_field_save_failed',
                'Could not save the review field.'
            );
        }

        return true;
    }
}
