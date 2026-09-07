<?php
use Elementor\Controls_Manager;
use Elementor\Repeater;

 class rvts_field_type_control {

    public function register_controls (Repeater $repeater) {
        $repeater->add_control(
            'field_type',
            [
                'label' => esc_html__( 'Field Type', 'reviewits' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'text' => esc_html__( 'Name', 'reviewits' ),
                    'textarea' => esc_html__( 'Textarea', 'reviewits' ),
                    'email' => esc_html__( 'Email', 'reviewits' ),
                    'checkbox' => esc_html__( 'Checkbox', 'reviewits' ),
                    'image' => esc_html__( 'Image', 'reviewits' ),
                    'rating' => esc_html__( 'Rating', 'reviewits' ),
                ],
                'default' => 'text',
            ]
        );
       
    }
}