<?php
use Elementor\Widget_Base;
class rvts_form_input_placeholder_color_control{
    
    public function register_style_controls(Widget_Base $widget){
        $widget->add_control(
            'rvts_form_input_placeholder_color',
            [
                'label' => esc_html__( 'Placeholder Color', 'reviewits' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rvts-form-group input::placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rvts-form-group textarea::placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );
    }
}