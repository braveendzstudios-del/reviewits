<?php

class rvts_review_text_read_more_control {

    public function register( \Elementor\Widget_Base $widget ) {

        $widget->add_control(
            'read_more_text',
            [
                'label' => esc_html__(
                    'Read More Text',
                    'reviewits'
                ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__(
                    'Read More',
                    'reviewits'
                ),
                'placeholder' => esc_html__(
                    'Read More',
                    'reviewits'
                ),
            ]
        );
    }
}