<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use \Elementor\Widget_Base;

class rvts_review_image_height_control {

    public function register( Widget_Base $widget ) {

        $widget->start_controls_section(
            'review_image_height_section',
            [
                'label' => esc_html__( 'Image Height', 'reviewits' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $widget->add_responsive_control(
            'review_image_height',
            [
                'label'      => esc_html__( 'Height', 'reviewits' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vh' ],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .rvts-review-image' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $widget->end_controls_section();
    }
}