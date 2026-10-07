<?php

class rvts_review_grid_layout_controls {

    public function register( \Elementor\Widget_Base $widget ) {

        /*
         * ==========================================
         * COLUMNS
         * ==========================================
         */

        $widget->add_control(
            'columns',
            [
                'label' => esc_html__(
                    'Columns',
                    'reviewits'
                ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'step' => 1,
                'default' => 1,
            ]
        );


        /*
         * ==========================================
         * ROWS
         * ==========================================
         */

        $widget->add_control(
            'rows',
            [
                'label' => esc_html__(
                    'Rows',
                    'reviewits'
                ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'step' => 1,
                'default' => 1,
            ]
        );
    }
}