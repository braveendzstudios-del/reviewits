<?php

class rvts_review_loop {

    public function render(
        int $template_id,
        array $reviews
    ) {

        if ( ! $template_id || empty( $reviews ) ) {

            return;
        }


        foreach ( $reviews as $review ) {

            if ( empty( $review['id'] ) ) {

                continue;
            }


            rvts_review_context::set(
                absint( $review['id'] )
            );


            echo \Elementor\Plugin::instance()
                ->frontend
                ->get_builder_content_for_display(
                    $template_id
                );
        }


        rvts_review_context::clear();
    }
}