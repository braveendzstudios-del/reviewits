<?php

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class rvts_form_field_gap_control {

public function register_style_controls(Widget_Base $widget) {
      $widget->add_control(
            'rvts_form_field_gap',
            [
                'label' => esc_html__( 'Form Field Gap', 'reviewits' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
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
                'selectors' => [
                    '{{WRAPPER}} .rvts-review-fields' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
}
}