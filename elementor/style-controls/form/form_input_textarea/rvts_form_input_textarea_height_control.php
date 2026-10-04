<?php
use Elementor\Widget_Base;
class rvts_form_input_textarea_height_control{
    public function register_style_controls(Widget_Base $widget){
        $widget->add_responsive_control(
            'rvts_form_textarea_height',
            [
                'label' => esc_html__( 'Text Area Height', 'reviewits' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' , '%' , 'vh' ],

                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%'=>[
                        'min' => 1,
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
                    'vh'=>[
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .rvts-form-group textarea' =>
                        'height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
    }
}