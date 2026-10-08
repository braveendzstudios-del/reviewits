<?php

class rvts_review_text_toggle_typography_control {

    public function register( \Elementor\Widget_Base $widget ) {

        $widget->start_controls_section(
            'review_text_toggle_typography_section',
            [
                'label' => esc_html__(
                    'Read More / Read Less Typography',
                    'reviewits'
                ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $widget->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'toggle_typography',
                'selector' =>
                    '{{WRAPPER}} .rvts-review-text-toggle',
            ]
        );

        $widget->end_controls_section();
    }
}