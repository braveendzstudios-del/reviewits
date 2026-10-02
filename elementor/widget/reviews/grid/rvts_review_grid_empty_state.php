<?php

class rvts_review_grid_empty_state {

    public function render() {

        echo '
        <div class="rvts-review-grid-empty">

            <div class="rvts-review-grid-empty-icon">
                <i class="eicon-posts-grid"></i>
            </div>

            <h3>
                ' .
                esc_html__(
                    'Review Grid starts with a template.',
                    'reviewits'
                )
                . '
            </h3>

            <p>
                ' .
                esc_html__(
                    'Either choose an existing template or create a new one and use it as the main item for your review grid.',
                    'reviewits'
                )
                . '
            </p>

        </div>';

        echo '
        <style>

            .rvts-review-grid-empty {
                width: 100%;
                min-height: 260px;
                padding: 45px 30px;
                box-sizing: border-box;
                border: 1px dashed #d5d8dc;
                border-radius: 8px;
                background: #fafafa;
                text-align: center;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            .rvts-review-grid-empty-icon {
                width: 52px;
                height: 52px;
                margin-bottom: 18px;
                border-radius: 50%;
                background: #f1f3f5;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .rvts-review-grid-empty-icon i {
                font-size: 24px;
                color: #6d7882;
            }

            .rvts-review-grid-empty h3 {
                margin: 0 0 10px;
                font-size: 18px;
                font-weight: 600;
                color: #1f2124;
            }

            .rvts-review-grid-empty p {
                max-width: 560px;
                margin: 0;
                font-size: 13px;
                line-height: 1.6;
                color: #6d7882;
            }

        </style>';
    }
}