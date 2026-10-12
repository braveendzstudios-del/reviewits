<?php

class rvts_review_text_character_limit_control {

    public function register( \Elementor\Widget_Base $widget ) {

        $widget->add_control(
            'character_limit',
            [
                'label' => esc_html__(
                    'Maximum Characters',
                    'reviewits'
                ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'step' => 1,
                'default' => 250,
            ]
        );
    }
}