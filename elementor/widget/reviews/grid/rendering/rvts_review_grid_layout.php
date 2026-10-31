<?php

class rvts_review_grid_layout {

    public function render(
        array $settings,
        array $reviews,
        int $template_id
    ) {

        /*
         * Desktop settings.
         */
        $columns = isset( $settings['columns'] )
            ? max( 1, absint( $settings['columns'] ) )
            : 3;

        $rows = isset( $settings['rows'] )
            ? max( 1, absint( $settings['rows'] ) )
            : 2;

        /*
         * Tablet settings.
         */
        $tablet_columns = isset( $settings['columns_tablet'] )
            ? max( 1, absint( $settings['columns_tablet'] ) )
            : 2;

        $tablet_rows = isset( $settings['rows_tablet'] )
            ? max( 1, absint( $settings['rows_tablet'] ) )
            : 3;

        /*
         * Mobile settings.
         */
        $mobile_columns = isset( $settings['columns_mobile'] )
            ? max( 1, absint( $settings['columns_mobile'] ) )
            : 1;

        $mobile_rows = isset( $settings['rows_mobile'] )
            ? max( 1, absint( $settings['rows_mobile'] ) )
            : 6;

        /*
         * Calculate the maximum number of reviews
         * needed across all device layouts.
         */
        $max_reviews = max(
            $columns * $rows,
            $tablet_columns * $tablet_rows,
            $mobile_columns * $mobile_rows
        );

        $reviews = array_slice(
            $reviews,
            0,
            $max_reviews
        );

        if ( empty( $reviews ) ) {
            return;
        }

        /*
         * Review Grid.
         *
         * CSS custom properties allow the enqueued
         * stylesheet to control each breakpoint.
         */
        echo '<div class="rvts-review-grid"';

        echo ' style="';
        echo '--rvts-columns-desktop:' .
            esc_attr( $columns ) . ';';
        echo '--rvts-columns-tablet:' .
            esc_attr( $tablet_columns ) . ';';
        echo '--rvts-columns-mobile:' .
            esc_attr( $mobile_columns ) . ';';
        echo '">';

        /*
         * Render review cards.
         */
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