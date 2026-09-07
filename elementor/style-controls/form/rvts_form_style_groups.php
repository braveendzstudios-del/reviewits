<?php

Class rvts_form_style_groups {

    public function rvts_get_groups() {
        return [
            'form' => [
                'label' => esc_html__( 'Form Style', 'reviewits' ),
                'controls' => [
                    'rvts_form_field_gap_control',
                    'rvts_form_label_gap_control'
                ],
            ],

            'label' => [
                'label' => esc_html__( 'Label Style', 'reviewits' ),
                'controls' => [
                    'rvts_form_label_typography_control',
                    'rvts_form_label_color_control',
                ],
            ],
            
        ];
        
        
        
    }
}