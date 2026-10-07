<?php

class rvts_review_heading_typography_control {

    public function register( \Elementor\Widget_Base $widget ) {

        $widget->start_controls_section(
            'heading_typography_section',
            [
                'label' => esc_html__(
                    'Typography',
                    'reviewits'
                ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $widget->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' =>
                    '{{WRAPPER}} .rvts-review-heading',
            ]
        );

        $widget->end_controls_section();
    }
}