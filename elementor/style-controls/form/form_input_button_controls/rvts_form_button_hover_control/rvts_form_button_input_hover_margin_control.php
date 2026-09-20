<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class rvts_form_button_input_hover_margin_control {

    public function register_style_controls( Widget_Base $widget ) {

        $widget->add_responsive_control(
            'rvts_form_button_hover_margin',
            [
                'label' => esc_html__( 'Margin', 'reviewits' ),
                'type'  => Controls_Manager::DIMENSIONS,

                'size_units' => [ 'px', 'em', 'rem', '%' ],

                'selectors' => [
                    '{{WRAPPER}} .rvts-form-group button[type="submit"]:hover' =>
                        'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    }
}