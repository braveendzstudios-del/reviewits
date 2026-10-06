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

            $content = \Elementor\Plugin::instance()
                ->frontend
                ->get_builder_content(
                    $template_id
                );

            echo $content;
        }

        rvts_review_context::clear();
    }
}