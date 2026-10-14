
<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class rvts_get_review_fields {

    public function get( int $review_id ) {

        global $wpdb;

        $table = $wpdb->prefix . 'rvts_review_fields';

        $fields = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT *
                FROM {$table}
                WHERE review_id = %d
                ORDER BY id ASC",
                absint( $review_id )
            ), // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared -- Table name uses the trusted WordPress database prefix and a fixed suffix; review_id uses a prepared placeholder.
            ARRAY_A
        );

        if ( empty( $fields ) ) {
            return [];
        }

        return $fields;
    }
}
