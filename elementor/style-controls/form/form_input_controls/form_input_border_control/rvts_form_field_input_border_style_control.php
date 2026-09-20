<?php 
use Elementor\Widget_Base;
class rvts_form_field_input_border_style_control{
    public function register_style_controls(Widget_Base $widget){

        $widget->add_control(
            'rvts_form_field_input_border_style',
            [
                'label' => esc_html__( 'Input Field Border Style', 'reviewits' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Default', 'reviewits' ),
                    'none' => esc_html__( 'None', 'reviewits' ),
                    'solid' => esc_html__( 'Solid', 'reviewits' ),
                    'dashed' => esc_html__( 'Dashed', 'reviewits' ),
                    'dotted' => esc_html__( 'Dotted', 'reviewits' ),
                    'double' => esc_html__( 'Double', 'reviewits' ),
                    'groove' => esc_html__( 'Groove', 'reviewits' ),
                    'ridge' => esc_html__( 'Ridge', 'reviewits' ),
                    'inset' => esc_html__( 'Inset', 'reviewits' ),
                    'outset' => esc_html__( 'Outset', 'reviewits' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .rvts-form-group input[type=text], {{WRAPPER}} 
                    .rvts-form-group textarea' => 
                    '-webkit-border-style: {{VALUE}}; border-style: {{VALUE}};',
                ],
            ]
        );
    }
}