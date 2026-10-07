<?php

class rvts_review_heading_alignment_control {

    public function register( \Elementor\Widget_Base $widget ) {

        $widget->start_controls_section(
            'heading_alignment_section',
            [
                'label' => esc_html__(
                    'Alignment',
                    'reviewits'
                ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $widget->add_responsive_control(
            'heading_alignment',
            [
                'label' => esc_html__(
                    'Alignment',
                    'reviewits'
                ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__(
                            'Left',
                            'reviewits'
                        ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__(
                            'Center',
                            'reviewits'
                        ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__(
                            'Right',
                            'reviewits'
                        ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .rvts-review-heading' =>
                        'text-align: {{VALUE}};',
                ],
            ]
        );

        $widget->end_controls_section();
    }
}