<?php
use Elementor\Widget_Base;
class rvts_form_input_star_rating_size_control{
    public function register_style_controls(Widget_Base $widget){
        $widget->add_responsive_control(
            'rvts_form_star_rating_size',
            [
                'label' => esc_html__( 'Rating Size', 'reviewits' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' , '%'],

                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0.1,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => 0.1,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                    '%'=>[
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],

                'selectors' => [
                    '{{WRAPPER}} .rvts-form-group .rvts-rating img' =>
                        'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
    }
}