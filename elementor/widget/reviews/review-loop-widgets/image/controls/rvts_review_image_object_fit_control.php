<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use \Elementor\Widget_Base;

class rvts_review_image_object_fit_control {

    public function register( Widget_Base $widget ) {

        $widget->start_controls_section(
            'review_image_object_fit_section',
            [
                'label' => esc_html__( 'Image Object Fit', 'reviewits' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $widget->add_responsive_control(
            'review_image_object_fit',
            [
                'label'   => esc_html__( 'Object Fit', 'reviewits' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'fill'        => esc_html__( 'Fill', 'reviewits' ),
                    'cover'       => esc_html__( 'Cover', 'reviewits' ),
                    'contain'     => esc_html__( 'Contain', 'reviewits' ),
                    'none'        => esc_html__( 'None', 'reviewits' ),
                    'scale-down'  => esc_html__( 'Scale Down', 'reviewits' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .rvts-review-image' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $widget->end_controls_section();
    }
}
