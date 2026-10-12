<?php

class rvts_review_text_read_more {

    public function render(
        string $text,
        int $character_limit,
        string $read_more_text,
        string $read_less_text
    ) {

        /*
         * No limit
         */
        if ( $character_limit <= 0 ) {

            echo wp_kses_post(
                nl2br(
                    esc_html( $text )
                )
            );

            return;
        }


        /*
         * Text does not exceed the limit.
         *
         * Show the complete text and
         * DO NOT show the button.
         */
        if ( mb_strlen( $text ) <= $character_limit ) {

            echo wp_kses_post(
                nl2br(
                    esc_html( $text )
                )
            );

            return;
        }


        /*
         * Text exceeds the limit.
         */

        $short_text = mb_substr(
            $text,
            0,
            $character_limit
        );

        echo '<div class="rvts-review-text-read-more">';


        /*
        * Short text
        */

        echo '<div class="rvts-review-text-short">';

        echo wp_kses_post(
            nl2br(
                esc_html( $short_text )
            )
        );

        echo '...';

        echo '</div>';


        /*
        * Full text
        */

        echo '<div
            class="rvts-review-text-full"
            style="display:none;"
        >';

        echo wp_kses_post(
            nl2br(
                esc_html( $text )
            )
        );

        echo '</div>';


        /*
        * Button
        */

        echo '<div class="rvts-review-text-toggle-wrapper">';

        echo '<button
            type="button"
            class="rvts-review-text-toggle"
            aria-expanded="false"
            data-read-more="' .
                esc_attr( $read_more_text ) .
            '"
            data-read-less="' .
                esc_attr( $read_less_text ) .
            '"
        >';

        echo esc_html(
            $read_more_text
        );

        echo '</button>';

        echo '</div>';


        echo '</div>';
    }
}