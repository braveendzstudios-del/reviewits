<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class rvts_form_button_input_normal_border_control {

    public function register_style_controls( Widget_Base $widget ) {

        /*
         * Border Type
         */
        $widget->add_control(
            'rvts_form_button_normal_border_type',
            [
                'label' => esc_html__( 'Border Type', 'reviewits' ),
                'type'  => Controls_Manager::SELECT,

                'options' => [
                    ''       => esc_html__( 'Default', 'reviewits' ),
                    'none'   => esc_html__( 'None', 'reviewits' ),
                    'solid'  => esc_html__( 'Solid', 'reviewits' ),
                    'double' => esc_html__( 'Double', 'reviewits' ),
                    'dotted' => esc_html__( 'Dotted', 'reviewits' ),
                    'dashed' => esc_html__( 'Dashed', 'reviewits' ),
                    'groove' => esc_html__( 'Groove', 'reviewits' ),
                ],

                'selectors' => [
                    '{{WRAPPER}} .rvts-form-group button[type="submit"]' =>
                        'border-style: {{VALUE}};',
                ],
            ]
        );


        /*
         * Border Width
         */
        $widget->add_responsive_control(
            'rvts_form_button_normal_border_width',
            [
                'label' => esc_html__( 'Border Width', 'reviewits' ),
                'type'  => Controls_Manager::DIMENSIONS,

                'size_units' => [ 'px', 'em', 'rem' ],

                'selectors' => [
                    '{{WRAPPER}} .rvts-form-group button[type="submit"]' =>
                        'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        /*
         * Border Color
         */
        $widget->add_control(
            'rvts_form_button_normal_border_color',
            [
                'label' => esc_html__( 'Border Color', 'reviewits' ),
                'type'  => Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .rvts-form-group button[type="submit"]' =>
                        'border-color: {{VALUE}};',
                ],
            ]
        );
    }
}