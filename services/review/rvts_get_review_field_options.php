<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class rvts_get_review_field_options {

    public function get() {

        global $wpdb;

        $table = $wpdb->prefix . 'rvts_review_fields';

        $cache_key = rvts_review_cache::make_key(
            'review_field_options'
        );

        $cache_found = false;

        $cached_options = wp_cache_get(
            $cache_key,
            rvts_review_cache::CACHE_GROUP,
            false,
            $cache_found
        );

        if ( $cache_found && is_array( $cached_options ) ) {
            return $cached_options;
        }

        // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery -- Reads distinct field IDs from the Reviewits custom table.
        $field_ids = $wpdb->get_col(
            $wpdb->prepare(
                "SELECT DISTINCT field_id
                FROM %i
                WHERE field_id != ''
                ORDER BY field_id ASC",
                $table
            )
        );

        $options = [
            '' => esc_html__(
                'Select Review Field',
                'reviewits'
            ),
        ];

        if ( is_array( $field_ids ) ) {

            foreach ( $field_ids as $field_id ) {

                $field_id = sanitize_key( $field_id );

                if ( '' === $field_id ) {
                    continue;
                }

                $options[ $field_id ] = ucwords(
                    str_replace(
                        [ '_', '-' ],
                        ' ',
                        $field_id
                    )
                );
            }
        }

        wp_cache_set(
            $cache_key,
            $options,
            rvts_review_cache::CACHE_GROUP,
            5 * MINUTE_IN_SECONDS
        );

        return $options;
    }
}