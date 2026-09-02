<?php
use Elementor\Controls_Manager;
use Elementor\Repeater;

class rvts_rating_control {

    public function register_controls (Repeater $repeater) {
        $repeater->add_control(
            'rating',
            [
                'label' => esc_html__( 'Rating', 'reviewits' ),
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

        //custom active star control
        $repeater->add_control(
            'active_star',
            [
                'label' => esc_html__( 'Active Star', 'reviewits' ),
                'type' => Controls_Manager::MEDIA,
                'media_types' => ['image/svg+xml'],
                'default' => [
                    'url' => plugins_url( '../assets/svg/star-active.svg', __FILE__ ),
                ],
                'condition' => [
                    'field_type' => ['rating'],
                ],
            ]
        );

        //custom inactive star control 
        $repeater->add_control(
            'inactive_star',
            [
                'label' => esc_html__( 'Inactive Star', 'reviewits' ),
                'type' => Controls_Manager::MEDIA,
                'media_types' => ['image/svg+xml'],
                'default' => [
                    'url' => plugins_url( '../assets/svg/star-inactive.svg', __FILE__ ),
                ],
                'condition' => [
                    'field_type' => ['rating'],
                ],
            ]
        );
    }
}