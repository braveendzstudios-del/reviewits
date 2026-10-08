<?php

class rvts_review_text_toggle_margin_control {

    public function register( \Elementor\Widget_Base $widget ) {

        $widget->start_controls_section(
            'review_text_toggle_margin_section',
            [
                'label' => esc_html__(
                    'Read More / Read Less Margin',
                    'reviewits'
                ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $widget->add_responsive_control(
            'toggle_margin',
            [
                'label' => esc_html__(
                    'Margin',
                    'reviewits'
                ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .rvts-review-text-toggle-wrapper' =>
                        'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $widget->end_controls_section();
    }
}