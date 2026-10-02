<?php

class rvts_review_grid_render {

    public function render( array $settings ) {

        $template_id = isset( $settings['template_id'] )
            ? absint( $settings['template_id'] )
            : 0;


        if ( ! $template_id ) {

            ( new rvts_review_grid_empty_state() )->render();

            return;
        }


        $reviews = ( new rvts_get_reviews() )->get([
            'limit'  => 10,
            'offset' => 0,
        ]);


        if ( empty( $reviews ) ) {

            ( new rvts_review_grid_empty_state() )->render();

            return;
        }


        echo '<div class="rvts-review-grid">';


        ( new rvts_review_loop() )->render(
            $template_id,
            $reviews
        );


        echo '</div>';
    }
}