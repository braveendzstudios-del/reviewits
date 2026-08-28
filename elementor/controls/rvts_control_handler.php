<?php
use Elementor\Repeater;
class rvts_control_handler {


    public function register_controls(Repeater $repeater) {
      
        $controls =[
            new rvts_label_type_control(), 
            new rvts_placeholder_control(),
            new rvts_required_control(),
            new rvts_rating_control(),
            new rvts_image_control(),
            new rvts_field_type_control(),

        ];

        foreach ($controls as $control) {
            $control->register_controls($repeater);
        }
        
    }
}