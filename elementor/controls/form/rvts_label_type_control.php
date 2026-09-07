<?php
use Elementor\Controls_Manager;
use Elementor\Repeater;

class rvts_label_type_control {

    public function register_controls (Repeater $repeater) {
        $repeater->add_control(
            'label_type',
            [
                'label' => esc_html__( 'Label', 'reviewits' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'options' => [
                    'text' => esc_html__( 'Text', 'reviewits' ),
                    'html' => esc_html__( 'HTML', 'reviewits' ),
                ],

                'condition' => [
                    'field_type' => ['text', 'textarea', 'select', 'email', 'checkbox', 'rating', 'image'],
                ],
            ]
        );
       
    }
}