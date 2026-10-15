
<?php

if (! defined('ABSPATH')) {
    exit;
}

class rvts_get_review_fields
{

    public function get(int $review_id)
    {

        global $wpdb;

        $table = $wpdb->prefix . 'rvts_review_fields';
        // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery -- Reads from the Reviewits custom fields table; WordPress core APIs do not provide this query.
        $fields = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT *
                FROM %i
                WHERE review_id = %d
                ORDER BY id ASC",
                $table,
                absint($review_id)
            ),
            ARRAY_A
        );


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


        if (empty($fields)) {
            return [];
        }

        return $fields;
    }
}
