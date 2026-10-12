<?php

class rvts_review_text_typography_control {

    public function register( \Elementor\Widget_Base $widget ) {

        $widget->start_controls_section(
            'review_text_typography_section',
            [
                'label' => esc_html__(
                    'Text Typography',
                    'reviewits'
                ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $widget->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'review_text_typography',
                'selector' =>
                    '{{WRAPPER}} .rvts-review-text',
            ]
        );

        $widget->end_controls_section();
    }
}