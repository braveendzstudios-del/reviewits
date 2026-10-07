<?php

class rvts_review_grid_reviews_controls {

    public function register( \Elementor\Widget_Base $widget ) {

        $widget->add_control(
            'reviews_to_show',
            [
                'label' => esc_html__(
                    'Reviews to Show',
                    'reviewits'
                ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'all' => esc_html__(
                        'All',
                        'reviewits'
                    ),
                    'custom' => esc_html__(
                        'Custom Number',
                        'reviewits'
                    ),
                ],
                'default' => 'all',
            ]
        );

        $widget->add_control(
            'reviews_number',
            [
                'label' => esc_html__(
                    'Number of Reviews',
                    'reviewits'
                ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'step' => 1,
                'default' => 6,
                'condition' => [
                    'reviews_to_show' => 'custom',
                ],
            ]
        );
    }
}