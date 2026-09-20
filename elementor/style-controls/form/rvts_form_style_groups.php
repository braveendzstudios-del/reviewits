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
            
            'input' => [
                'label' => esc_html__( 'Input Style', 'reviewits' ),
                'controls' => [
                    'rvts_form_field_input_typography_control',
                    'rvts_form_field_input_typography_color_control',
                    'rvts_form_input_placeholder_typography_control',
                    'rvts_form_input_placeholder_color_control',
                    'rvts_form_field_padding_control',
                    'rvts_form_field_input_border_radius_control',
                    'rvts_form_field_input_border_control',
                    'rvts_form_field_input_border_style_control',
                    'rvts_form_field_input_border_color_control',
                ],
            ],

            'Rating' => [
                'label' => esc_html__( 'Rating Style', 'reviewits' ),
                'controls' => [
                    "rvts_form_input_star_rating_size_control",
                    "rvts_form_input_star_rating_gap_control"
                ],
            ],

            'Button' => [
                'label' => esc_html__( 'Button Style', 'reviewits' ),
                'controls' => [
                    "rvts_form_button_input_style_handler",
                ],
            ],
        ];
        
        
        
    }
}