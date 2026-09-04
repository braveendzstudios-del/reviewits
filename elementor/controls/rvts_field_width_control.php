<?php
use Elementor\Repeater;

class rvts_field_width_control {

    public function register_controls(Repeater $repeater) {
        $repeater->add_responsive_control(
            'field_width',
            [
                'label' => esc_html__( 'Field Width', 'reviewits' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'condition' => [
                    'field_type' => ['text', 'email', 'textarea',  'checkbox', 'image', 'rating'],
                ],
            ]
        );
    }
}