<?php

use Elementor\Widget_Base;
class rvts_form_field_input_border_color_control{
    
    public function register_style_controls(Widget_Base $widget){
        $widget->add_control(
            'rvts_form_field_input_border_color',
            [
                'label' => esc_html__( 'Input Field Border Color', 'reviewits' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rvts-form-group input[type=text], {{WRAPPER}} 
                    .rvts-form-group input[type=email], {{WRAPPER}} 
                    .rvts-form-group textarea' => 'border-color: {{VALUE}};',
                ],
            ]
        );
    }
}