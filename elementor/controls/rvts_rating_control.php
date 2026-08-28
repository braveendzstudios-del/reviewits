<?php
use Elementor\Controls_Manager;
use Elementor\Repeater;

class rvts_rating_control {

    public function register_controls (Repeater $repeater) {
        $repeater->add_control(
            'stars',
            [
                'label' => esc_html__( 'Stars', 'reviewits' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 5,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'condition' => [
                    'field_type' => ['rating'],
                ],
            ]
        );
       
    }
}