
<?php

class rvts_review_stars_spacing_control {

    public function register( \Elementor\Widget_Base $widget ) {

        $widget->start_controls_section(
            'review_stars_spacing_section',
            [
                'label' => esc_html__(
                    'Star Spacing',
                    'reviewits'
                ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $widget->add_responsive_control(
            'star_spacing',
            [
                'label' => esc_html__(
                    'Star Spacing',
                    'reviewits'
                ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    'em' => [
                        'min'  => 0,
                        'max'  => 60,
                        'step' => 0.1,
                    ],
                    '%' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                    'vw' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 4,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rvts-review-stars' =>
                        'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $widget->end_controls_section();
    }
}
