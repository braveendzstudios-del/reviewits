
<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class rvts_review_stars_alignment_control {

    public function register( \Elementor\Widget_Base $widget ) {

        $widget->start_controls_section(
            'review_stars_alignment_section',
            [
                'label' => esc_html__(
                    'Star Alignment',
                    'reviewits'
                ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $widget->add_responsive_control(
            'star_alignment',
            [
                'label' => esc_html__(
                    'Alignment',
                    'reviewits'
                ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'reviewits' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'reviewits' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'reviewits' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .rvts-review-stars' =>
                        'width: 100%; justify-content: {{VALUE}};',
                ],
            ]
        );

        $widget->end_controls_section();
    }
}
