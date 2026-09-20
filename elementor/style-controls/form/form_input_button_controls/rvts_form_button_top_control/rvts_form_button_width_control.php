<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class rvts_form_button_width_control{
    public function register_style_controls( Widget_Base $widget ){

        $widget->add_responsive_control(
            'rvts_form_button_width',
            [
                'label' => esc_html__( 'Button Width', 'reviewits' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem' ],

                'range' => [

                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 0.1,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .rvts-sumbit-button' =>
                        'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

    }
}