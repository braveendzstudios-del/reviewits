<?php
use Elementor\Widget_Base;
class rvts_form_field_padding_control{
    
    public function register_style_controls(Widget_Base $widget){
        $widget->add_responsive_control(
            'rvts_form_field_padding',
            [
                'label' => esc_html__( 'Field Padding', 'reviewits' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .rvts-form-group input, {{WRAPPER}} .rvts-form-group textarea' => 
                    'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    }
}