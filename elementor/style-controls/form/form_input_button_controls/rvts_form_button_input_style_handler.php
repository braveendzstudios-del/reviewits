<?php

use Elementor\Widget_Base;

class rvts_form_button_input_style_handler{
    
    public function register_style_controls(Widget_Base $widget){
        $states = ((new rvts_form_button_input_styles_state_control)->rvts_get_states());

        /**
         * Top Controls
         */

        foreach ($states['top'] as $control_class){
            
            if(class_exists($control_class)){
                $control = new $control_class;

                if(method_exists( $control , 'register_style_controls')){
                    $control->register_style_controls( $widget );
                }
            }

        }

        /**
         * Normal Hover Tab
         */

        $widget->start_controls_tabs('rvts_form_button_style_tabs');

        /**
         * Normal
         */

        $widget->start_controls_tab(
            'rvts_form_button_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'reviewits' ),
            ]
        );

        foreach($states['normal'] as $control_class){

            if(class_exists($control_class)){
                $control = new $control_class;

                if(method_exists( $control , 'register_style_controls')){
                    $control->register_style_controls( $widget );
                }
            }

        }

        $widget->end_controls_tab();

        /**
         * Hover
        */

        $widget->start_controls_tab(
            'rvts_form_button_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'reviewits' ),
            ]
        );

        foreach($states['hover'] as $control_class){

            if(class_exists($control_class)){
                $control = new $control_class;

                if(method_exists( $control , 'register_style_controls')){
                    $control->register_style_controls( $widget );
                }
            }

        }

        $widget->end_controls_tab();
        $widget->end_controls_tabs();


        foreach($states['bottom'] as $control_class){

            if(class_exists($control_class)){
                $control = new $control_class;

                if(method_exists( $control , 'register_style_controls')){
                    $control->register_style_controls( $widget );
                }
            }

        }




    }
}