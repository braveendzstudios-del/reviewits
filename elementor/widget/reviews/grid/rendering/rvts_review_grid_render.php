<?php

class rvts_review_grid_render {

    public function render( array $settings ) {

        /*
         * Get review template.
         */
        $template_id = isset( $settings['template_id'] )
            ? absint( $settings['template_id'] )
            : 0;

        /*
         * No template selected.
         */
        if ( ! $template_id ) {
            ( new rvts_review_grid_empty_state() )->render();
            return;
        }

        /*
         * Get reviews.
         */
        $reviews_to_show = isset( $settings['reviews_to_show'] )
            ? $settings['reviews_to_show']
            : 'all';

        if ( 'custom' === $reviews_to_show ) {

            $reviews_number = isset( $settings['reviews_number'] )
                ? absint( $settings['reviews_number'] )
                : 1;

            $reviews = ( new rvts_get_reviews() )->get(
                [
                    'limit'  => max( 1, $reviews_number ),
                    'offset' => 0,
                ]
            );

        } else {

            $reviews = ( new rvts_get_reviews() )->get(
                [
                    'limit'  => 99999,
                    'offset' => 0,
                ]
            );
        }

        /*
         * No reviews found.
         */
        if ( empty( $reviews ) ) {
            ( new rvts_review_grid_empty_state() )->render(
                'reviews'
            );
            return;
        }

        /*
         * Render the grid.
         * The layout renderer creates the grid wrapper.
         */
        ( new rvts_review_grid_layout() )->render(
            $settings,
            $reviews,
            $template_id
        );
    }
}