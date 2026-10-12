<?php

class rvts_review_text_color_control {

    public function register( \Elementor\Widget_Base $widget ) {

        $widget->start_controls_section(
            'review_text_color_section',
            [
                'label' => esc_html__(
                    'Text Color',
                    'reviewits'
                ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $widget->add_control(
            'text_color',
            [
                'label' => esc_html__(
                    'Text Color',
                    'reviewits'
                ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rvts-review-text' =>
                        'color: {{VALUE}};',
                ],
            ]
        );

        $widget->end_controls_section();
    }
}