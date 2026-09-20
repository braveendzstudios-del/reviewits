<?php

class rvts_form_button_input_styles_state_control{
    
    public function rvts_get_states(){
        return[
                
            'top'=>[
                'rvts_form_button_typography_control',
                'rvts_form_button_width_control',
            ],  
            
            'normal' => [
                'rvts_form_button_input_normal_text_color_control',
                'rvts_form_button_input_normal_background_color_control',
                'rvts_form_button_input_normal_border_control',
                'rvts_form_button_input_normal_border_radius_control',
                'rvts_form_button_input_normal_padding_control',
                'rvts_form_button_input_normal_margin_control',
                'rvts_form_button_input_normal_box_shadow_control',
            ],
            


            'hover' => [
                'rvts_form_button_input_hover_text_color_control',
                'rvts_form_button_input_hover_background_color_control',
                'rvts_form_button_input_hover_border_control',
                'rvts_form_button_input_hover_border_radius_control',
                'rvts_form_button_input_hover_padding_control',
                'rvts_form_button_input_hover_margin_control',
                'rvts_form_button_input_hover_box_shadow_control',
            ],

            'bottom' => [
        
            ],

        ];
    }    

}