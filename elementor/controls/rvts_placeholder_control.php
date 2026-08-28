<?php
use Elementor\Controls_Manager;
use Elementor\Repeater;

class rvts_placeholder_control {

    public function register_controls (Repeater $repeater) {
        $repeater->add_control(
            'placeholder',
            [
                'label' => esc_html__( 'Placeholder', 'reviewits' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'condition' => [
                    'field_type' => ['text', 'textarea', 'email'],
                ],
            ]
        );
       
    }
}