<?php

class rvts_review_grid_style_controls {

    public function register( \Elementor\Widget_Base $widget ) {

        $widget->start_controls_section(
            'grid_layout_section',
            [
                'label' => esc_html__(
                    'Layout',
                    'reviewits'
                ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        /**Row */

        $widget->add_control(
            'rows_gap',
            [
                'label' => esc_html__(
                    'Rows Gap',
                    'reviewits'
                ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rvts-review-grid' =>
                        'row-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        /**Column*/

        $widget->add_control(
            'columns_gap',
            [
                'label' => esc_html__(
                    'Columns Gap',
                    'reviewits'
                ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rvts-review-grid' =>
                        'column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $widget->end_controls_section();
    }
}