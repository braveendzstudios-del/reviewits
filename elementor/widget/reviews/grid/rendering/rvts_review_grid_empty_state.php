<?php

class rvts_review_grid_empty_state
{

    public function render(string $type = 'template')
    {

        /*
         * --------------------------------------------------
         * EMPTY STATE CONTENT
         * --------------------------------------------------
         */

        if ($type === 'reviews') {

            $title = esc_html__(
                'No Reviews Found',
                'reviewits'
            );

            $description = esc_html__(
                'There are no reviews to display yet.',
                'reviewits'
            );
        } else {

            $title = esc_html__(
                'Select a Review Template',
                'reviewits'
            );

            $description = esc_html__(
                'Choose a Review Template to display your reviews.',
                'reviewits'
            );
        }


        /*
         * --------------------------------------------------
         * EMPTY STATE HTML
         * --------------------------------------------------
         */

        echo '
        <div class="rvts-review-grid-empty">

            <div class="rvts-review-grid-empty-icon">
                <i class="eicon-posts-grid"></i>
            </div>

            <h3>
                ' . esc_html($title) . '
            </h3>

            <p>
                ' . esc_html($description) . '
            </p>

        </div>';
    }
}
