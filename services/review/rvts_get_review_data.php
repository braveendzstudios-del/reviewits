<?php

class rvts_get_review_data {

    public function get( array $args = [] ) {

        $reviews = (
            new rvts_get_reviews()
        )->get( $args );

        if ( empty( $reviews ) ) {
            return [];
        }

        $field_service = new rvts_get_review_fields();

        foreach ( $reviews as &$review ) {

            $review_id = isset( $review['id'] )
                ? absint( $review['id'] )
                : 0;

            $review['fields'] = $review_id
                ? $field_service->get( $review_id )
                : [];

        }

        unset( $review );

        return $reviews;
    }
}