<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class rvts_form_button_input_hover_text_color_control{
    
    public function register_style_controls( Widget_Base $widget ) {

        $widget->add_control(
            'rvts_form_button_hover_text_color',
            [
                'label' => esc_html__( 'Text Color', 'reviewits' ),
                'type'  => Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .rvts-form-group button[type="submit"]:hover' =>
                        'color: {{VALUE}};',
                ],
            ]
        );
    }
}