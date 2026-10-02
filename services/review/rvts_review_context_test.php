<?php

class rvts_review_context_test {

    public function render() {

        $review = rvts_review_context::get();

        if ( empty( $review ) ) {
            return;
        }

        echo '<pre>';
        print_r( $review );
        echo '</pre>';
    }
}