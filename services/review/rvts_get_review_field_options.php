<?php

class rvts_get_review_field_options {

    public function get() {

        global $wpdb;

        $table = $wpdb->prefix . 'rvts_review_fields';


        $field_ids = $wpdb->get_col(
            "
            SELECT DISTINCT field_id
            FROM {$table}
            WHERE field_id != ''
            ORDER BY field_id ASC
            "
        );


        $options = [
            '' => esc_html__(
                'Select Review Field',
                'reviewits'
            ),
        ];


        foreach ( $field_ids as $field_id ) {

            $field_id = sanitize_key( $field_id );

            $options[ $field_id ] = $field_id;
        }


        return $options;
    }
}