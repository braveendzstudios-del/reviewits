<?php
use Elementor\Controls_Manager;
use Elementor\Repeater;

class rvts_image_control {

    public function register_controls (Repeater $repeater) {
        $repeater->add_control(
            'image',
            [
                'label' => esc_html__( 'Image', 'reviewits' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'field_type' => ['image'],
                ],
            ]
        );
       
    }
}