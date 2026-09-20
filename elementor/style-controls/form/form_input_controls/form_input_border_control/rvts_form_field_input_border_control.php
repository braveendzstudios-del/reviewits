<?php
use Elementor\Widget_Base;
class rvts_form_field_input_border_control{
    public function register_style_controls(Widget_Base $widget){
        $widget->add_responsive_control(
            'rvts_form_field_input_border',
            [
                'label' => esc_html__( 'Input Field Border', 'reviewits' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .rvts-form-group input[type=text], {{WRAPPER}} 
                    .rvts-form-group input[type=email], {{WRAPPER}} 
                    .rvts-form-group textarea' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    }
}