<?php
use Elementor\Widget_Base;
class rvts_form_input_placeholder_typography_control{
    
    public function register_style_controls(Widget_Base $widget){
        $widget->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'rvts_form_input_placeholder_typography',
                'label' => esc_html__( 'Placeholder Typography', 'reviewits' ),
                'selector' => '{{WRAPPER}} .rvts-form-group input::placeholder, 
                {{WRAPPER}} .rvts-form-group textarea::placeholder',
            ]
        );
    }
}