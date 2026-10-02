<?php

class rvts_get_reviews {

    public function get( array $args = [] ) {

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
            absint( $args['limit'] )
        );

        $offset = max(
            0,
            absint( $args['offset'] )
        );

        $table = $wpdb->prefix . 'rvts_reviews';

        $reviews = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT *
                FROM {$table}
                ORDER BY created_at DESC
                LIMIT %d OFFSET %d",
                $limit,
                $offset
            ),
            ARRAY_A
        );

        if ( empty( $reviews ) ) {
            return [];
        }

        return $reviews;
    }
}