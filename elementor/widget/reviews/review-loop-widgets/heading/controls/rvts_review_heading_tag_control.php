<?php

class rvts_review_heading_tag_control {

    public function register( \Elementor\Widget_Base $widget ) {

        $widget->add_control(
            'heading_tag',
            [
                'label' => esc_html__(
                    'HTML Tag',
                    'reviewits'
                ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'h1'  => 'H1',
                    'h2'  => 'H2',
                    'h3'  => 'H3',
                    'h4'  => 'H4',
                    'h5'  => 'H5',
                    'h6'  => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                ],
                'default' => 'h4',
            ]
        );
    }
}