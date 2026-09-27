<?php

class rvts_save_review {

    public function save() {

        global $wpdb;

        $table = $wpdb->prefix . 'rvts_reviews';

        $inserted = $wpdb->insert(
            $table,
            [
                'status' => 'pending',
            ],
            [
                '%s',
            ]
        );

        if ( false === $inserted ) {

            return new WP_Error(
                'review_save_failed',
                'Could not save the review.'
            );

        }

        return (int) $wpdb->insert_id;
    }
}