<?php

if (! defined('ABSPATH')) {
    exit;
}

class rvts_save_review
{

    public function save()
    {

        global $wpdb;


        $table = $wpdb->prefix . 'rvts_reviews';
        // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery -- Writes to the Reviewits custom reviews table; no equivalent WordPress core insert API exists.
        $inserted = $wpdb->insert(
            $table,
            [
                'status' => 'pending',
            ],
            [
                '%s',
            ]
        );

        if (false === $inserted) {
            return new WP_Error(
                'review_save_failed',
                'Could not save the review.'
            );
        }

        rvts_review_cache::invalidate();

        return (int) $wpdb->insert_id;
    }
}
