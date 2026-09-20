<?php
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
class rvts_form_button_typography_control{
    public function register_style_controls( Widget_Base $widget ) {

        $widget->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'rvts_form_button_typography',
                'selector' => '{{WRAPPER}} .rvts-form-group button[type="submit"]',
            ]
        );

    }
}