<?php
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
class rvts_form_label_typography_control {

    public function register_style_controls(Widget_Base $widget) {
        $widget->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'rvts_form_label_typography',
                'label' => esc_html__( 'Label Typography', 'reviewits' ),
                'selector' => '{{WRAPPER}} .rvts-review-fields label',
            ]
        );
    } 

}