<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

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

    public static function get_properties() {
        $properties = parent::get_properties();

        // This reusable document does not need a layout selector.
        $properties['support_page_layout'] = false;

        // Allow page-template handling where Elementor supports it.
        $properties['support_wp_page_templates'] = true;

        return $properties;
    }
}
