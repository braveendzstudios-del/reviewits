
<?php

if (! defined('ABSPATH')) {
    exit;
}

class rvts_get_review_fields
{

    public function get(int $review_id)
    {

        global $wpdb;

        $review_id = absint($review_id);

        $cache_key = rvts_review_cache::make_key(
            'review_fields',
            [$review_id]
        );

        $cache_found = false;

        $cached_fields = wp_cache_get(
            $cache_key,
            rvts_review_cache::CACHE_GROUP,
            false,
            $cache_found
        );

        if ($cache_found) {
            return $cached_fields;
        }

        $table = $wpdb->prefix . 'rvts_review_fields';

        // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery -- Reads from the Reviewits custom fields table; WordPress core APIs do not provide this query.
        $fields = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT *
                FROM %i
                WHERE review_id = %d
                ORDER BY id ASC",
                $table,
                $review_id
            ),
            ARRAY_A
        );

        $fields = empty($fields) ? [] : $fields;

        wp_cache_set(
            $cache_key,
            $fields,
            rvts_review_cache::CACHE_GROUP,
            5 * MINUTE_IN_SECONDS
        );

        return $fields;
    }
}
