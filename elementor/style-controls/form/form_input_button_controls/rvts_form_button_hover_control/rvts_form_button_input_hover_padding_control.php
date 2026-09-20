<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class rvts_form_button_input_hover_padding_control {

    public function register_style_controls( Widget_Base $widget ) {

        $widget->add_responsive_control(
            'rvts_form_button_hover_padding',
            [
                'label' => esc_html__( 'Padding', 'reviewits' ),
                'type'  => Controls_Manager::DIMENSIONS,

                'size_units' => [ 'px', 'em', 'rem', '%' ],

                'selectors' => [
                    '{{WRAPPER}} .rvts-form-group button[type="submit"]:hover' =>
                        'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    }
}