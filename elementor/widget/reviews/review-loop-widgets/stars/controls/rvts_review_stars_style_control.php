
<?php

class rvts_review_stars_style_control {

    public function register( \Elementor\Widget_Base $widget ) {

        $widget->start_controls_section(
            'review_stars_style_section',
            [
                'label' => esc_html__(
                    'Stars',
                    'reviewits'
                ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $widget->add_responsive_control(
            'star_size',
            [
                'label' => esc_html__(
                    'Star Size',
                    'reviewits'
                ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' , 'em' , '%' , 'vh' ],
                'range' => [
                    'px' => [
                        'min' =>5,
                        'max' => 60,
                    ],
                    'em' => [
                        'min' => 0.5,
                        'max' => 3,
                        'step' => 0.1,
                    ],
                    '%' => [
                        'min' => 5,
                        'max' => 100,
                    ],
                    'vh' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rvts-review-star' =>
                        'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $widget->end_controls_section();
    }
}
