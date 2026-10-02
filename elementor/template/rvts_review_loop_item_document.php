<?php

class rvts_review_loop_item_document
    extends \Elementor\Modules\Library\Documents\Library_Document {

    public static function get_type() {

        return 'rvts-review-loop-item';
    }

    public static function get_title() {

        return esc_html__(
            'Review Loop Item',
            'reviewits'
        );
    }
}