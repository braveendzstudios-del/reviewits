<?php

use Elementor\Widget_Base;
use Elementor\Group_Control_Box_Shadow;

class rvts_form_button_input_normal_box_shadow_control {

    public function register_style_controls( Widget_Base $widget ) {

        $widget->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'rvts_form_button_normal_box_shadow',

                'label' => esc_html__( 'Box Shadow', 'reviewits' ),

                'selector' => '{{WRAPPER}} .rvts-review-fields button[type="submit"]',
            ]
        );
    }
}