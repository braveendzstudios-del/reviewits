<?php

class rvts_review_text_read_less_control {

    public function register( \Elementor\Widget_Base $widget ) {

        $widget->add_control(
            'read_less_text',
            [
                'label' => esc_html__(
                    'Read Less Text',
                    'reviewits'
                ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__(
                    'Read Less',
                    'reviewits'
                ),
                'placeholder' => esc_html__(
                    'Read Less',
                    'reviewits'
                ),
            ]
        );
    }
}