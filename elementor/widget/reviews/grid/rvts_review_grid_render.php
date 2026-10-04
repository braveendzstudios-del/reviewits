<?php

class rvts_review_grid_render {

    public function render( array $settings ) {

        /*
         * --------------------------------------------------
         * GET REVIEW TEMPLATE
         * --------------------------------------------------
         */

        $template_id = isset( $settings['template_id'] )
            ? absint( $settings['template_id'] )
            : 0;


        /*
         * --------------------------------------------------
         * NO TEMPLATE SELECTED
         * --------------------------------------------------
         */

        if ( ! $template_id ) {

            ( new rvts_review_grid_empty_state() )->render();

            return;
        }


        /*
         * --------------------------------------------------
         * GET REVIEWS
         * --------------------------------------------------
         */

        $reviews = ( new rvts_get_reviews() )->get(
            [
                'limit'  => 10,
                'offset' => 0,
            ]
        );


        /*
         * --------------------------------------------------
         * NO REVIEWS FOUND
         * --------------------------------------------------
         */

        if ( empty( $reviews ) ) {

            ( new rvts_review_grid_empty_state() )->render(
                'reviews'
            );

            return;
        }


        /*
         * --------------------------------------------------
         * REVIEW GRID
         * --------------------------------------------------
         */

        echo '<div class="rvts-review-grid">';


        /*
         * Render selected Review Template
         * for every review.
         */
        ( new rvts_review_loop() )->render(
            $template_id,
            $reviews
        );


        echo '</div>';
    }
}