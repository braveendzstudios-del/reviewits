
<?php

if (! defined('ABSPATH')) {
    exit;
}

class rvts_get_reviews
{

    public function get(array $args = [])
    {

        global $wpdb;

        $defaults = [
            'limit'  => 10,
            'offset' => 0,
        ];

        $args = wp_parse_args(
            $args,
            $defaults
        );

        $limit = max(
            1,
            absint($args['limit'])
        );

        $offset = max(
            0,
            absint($args['offset'])
        );

        $table = $wpdb->prefix . 'rvts_reviews';


        $cache_key = rvts_review_cache::make_key(
            'reviews',
            [$limit, $offset]
        );

        $cache_found = false;
        $cached_reviews = wp_cache_get(
            $cache_key,
            rvts_review_cache::CACHE_GROUP,
            false,
            $cache_found
        );

        if ($cache_found) {
            return $cached_reviews;
        }

        // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery -- Reads from the Reviewits custom reviews table; WordPress core APIs do not provide this query.

        $reviews = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT *
                FROM %i
                ORDER BY created_at DESC
                LIMIT %d OFFSET %d",
                $table,
                $limit,
                $offset
            ),
            ARRAY_A
        );


        $reviews = empty($reviews) ? [] : $reviews;

        wp_cache_set(
            $cache_key,
            $reviews,
            rvts_review_cache::CACHE_GROUP,
            5 * MINUTE_IN_SECONDS
        );

        return $reviews;
    }
}
