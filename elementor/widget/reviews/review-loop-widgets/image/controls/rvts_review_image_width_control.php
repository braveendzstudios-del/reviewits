
<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use \Elementor\Widget_Base;

class rvts_review_image_width_control {

    public function register( Widget_Base $widget ) {

        $widget->start_controls_section(
            'review_image_width_section',
            [
                'label' => esc_html__(
                    'Image Width',
                    'reviewits'
                ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $widget->add_responsive_control(
            'review_image_width',
            [
                'label' => esc_html__(
                    'Width',
                    'reviewits'
                ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rvts-review-image' =>
                        'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $widget->end_controls_section();
    }
}
