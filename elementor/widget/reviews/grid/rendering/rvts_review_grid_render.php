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
         * GET REVIWS
         * --------------------------------------------------
         */
        $reviews_to_show = isset( $settings['reviews_to_show'] )
        ? $settings['reviews_to_show']
        : 'all';

        if ( $reviews_to_show === 'custom' ) {

            $reviews_number = isset( $settings['reviews_number'] )
                ? absint( $settings['reviews_number'] )
                : 1;

            $reviews = ( new rvts_get_reviews() )->get([
                'limit'  => max( 1, $reviews_number ),
                'offset' => 0,
            ]);

        } else {

            $reviews = ( new rvts_get_reviews() )->get([
                'limit'  => 99999,
                'offset' => 0,
            ]);
        }   


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


    ( new rvts_review_grid_layout() )->render(
    $settings,
    $reviews,
    $template_id
);


        echo '</div>';
    }
}