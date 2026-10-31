<?php

class rvts_review_grid_layout_controls {

    public function register( \Elementor\Widget_Base $widget ) {

        /*
         * Columns
         */
        $widget->add_responsive_control(
            'columns',
            [
                'label' => esc_html__(
                    'Columns',
                    'reviewits'
                ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 12,
                'step' => 1,
                'default' => 3,
                'tablet_default' => 2,
                'mobile_default' => 1,
            ]
        );

        /*
         * Rows
         */
        $widget->add_responsive_control(
            'rows',
            [
                'label' => esc_html__(
                    'Rows',
                    'reviewits'
                ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 50,
                'step' => 1,
                'default' => 2,
                'tablet_default' => 3,
                'mobile_default' => 6,
            ]
        );
    }
}
