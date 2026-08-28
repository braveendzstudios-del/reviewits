<?php
use Elementor\Controls_Manager;
use Elementor\Repeater;

class rvts_required_control {

    public function register_controls (Repeater $repeater) {
        $repeater->add_control(
            'field_required',
            [
                'label' => esc_html__( 'Required', 'reviewits' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'reviewits' ),
                'label_off' => esc_html__( 'No', 'reviewits' ),
                'return_value' => 'yes',
                'default' => 'yes',
                
                'condition' => [
                    'field_type' => ['text', 'textarea', 'email', 'checkbox', 'rating', 'image'],
                ],
            ]

        );
       
    }
}