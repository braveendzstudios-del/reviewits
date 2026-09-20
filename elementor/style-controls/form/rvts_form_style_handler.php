<?php
use Elementor\Widget_Base;

class rvts_form_style_handler {

    public function __construct() {
        new rvts_form_style_autoloader();
    }

    public function register_style_controls (Widget_Base $widget){
        
        $groups = (new rvts_form_style_groups())->rvts_get_groups();

        foreach ($groups as $group_key => $group) {

            $widget->start_controls_section(
                'section_' . $group_key,
                [
                    'label' => $group['label'],
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );

            foreach ($group['controls'] as $control_class) {

                if (class_exists($control_class)) {
                    $control_instance = new $control_class();
                    if (method_exists($control_instance, 'register_style_controls')) {
                        $control_instance->register_style_controls($widget);
                    }
                }
            }

            $widget->end_controls_section();
        }

    }
}