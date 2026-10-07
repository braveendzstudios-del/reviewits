<?php

class rvts_review_grid_layout {

    public function render(
        array $settings,
        array $reviews,
        int $template_id
    ) {

        $columns = isset( $settings['columns'] )
            ? max( 1, absint( $settings['columns'] ) )
            : 3;

        $rows = isset( $settings['rows'] )
            ? max( 1, absint( $settings['rows'] ) )
            : 1;

        /*
         * Maximum reviews based on
         * columns × rows.
         */
        $max_reviews = $columns * $rows;

        $reviews = array_slice(
            $reviews,
            0,
            $max_reviews
        );

        if ( empty( $reviews ) ) {
            return;
        }

        /*
         * Actual CSS Grid
         */
        echo '<div class="rvts-review-grid" style="';
        echo 'display:grid;';
        echo 'grid-template-columns:repeat(' .
            esc_attr( $columns ) .
            ', minmax(0, 1fr));';
        echo '">';

        foreach ( $reviews as $review ) {

            if ( empty( $review['id'] ) ) {
                continue;
            }

            echo '<div class="rvts-review-grid-item">';

            ( new rvts_review_loop() )->render(
                $template_id,
                [ $review ]
            );

            echo '</div>';
        }

        echo '</div>';
    }
}