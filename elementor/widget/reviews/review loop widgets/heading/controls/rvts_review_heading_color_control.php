<?php

class rvts_review_heading_color_control {

    public function register( \Elementor\Widget_Base $widget ) {

        $widget->start_controls_section(
            'heading_color_section',
            [
                'label' => esc_html__(
                    'Color',
                    'reviewits'
                ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $widget->add_control(
            'heading_color',
            [
                'label' => esc_html__(
                    'Text Color',
                    'reviewits'
                ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rvts-review-heading' =>
                        'color: {{VALUE}};',
                ],
            ]
        );

        $widget->end_controls_section();
    }
}