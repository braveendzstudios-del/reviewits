<?php

use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

class rvts_form_label_color_control{
    function register_style_controls(Widget_Base $widget ) {
        $widget->add_control(
            'rvts_form_label_color',
            [
                'label' => esc_html__( 'Label Color', 'reviewits' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rvts-review-fields label' => 'color: {{VALUE}};',
                ],
            ]
        );
    }
}