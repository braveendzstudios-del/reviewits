<?php

if (! defined('ABSPATH')) {
    exit;
}

class rvts_save_review_image_field
{

    public function save(
        int $review_id,
        string $field_id,
        int $attachment_id
    ) {

        global $wpdb;
        // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery -- Writes to the Reviewits custom review fields table; no equivalent WordPress core insert API exists.

        $table = $wpdb->prefix . 'rvts_review_fields';

        $image_url = wp_get_attachment_url(
            $attachment_id
        );

        $inserted = $wpdb->insert(
            $table,
            [
                'review_id'   => $review_id,
                'field_id'    => sanitize_key($field_id),
                'field_type'  => 'image',
                'field_value' => $image_url ? $image_url : '',
            ],
            [
                '%d',
                '%s',
                '%s',
                '%s',
            ]
        );

        if (false === $inserted) {
            return new WP_Error(
                'review_image_field_save_failed',
                'Could not save the review image field.'
            );
        }

        return true;
    }
}
