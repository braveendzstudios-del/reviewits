<?php

use Elementor\Repeater;
use Elementor\Controls_Manager;

class rvts_form_field_id_control {

    public function register_controls( Repeater $repeater ) {

        $repeater->add_control(
            'field_id',
            [
                'label'       => esc_html__( 'Field ID', 'reviewits' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,

                'description' => esc_html__(
                    'Enter a unique ID for this field. Use only letters, numbers, hyphens or underscores.',
                    'reviewits'
                ),
            ]
        );
    }
}