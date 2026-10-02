<?php

class rvts_review_image extends \Elementor\Widget_Base {

    public function get_name() {

        return 'rvts_review_image';
    }

    public function get_title() {

        return esc_html__(
            'Review Image',
            'reviewits'
        );
    }

    public function get_icon() {

        return 'eicon-image';
    }

    public function get_categories() {

        return [ 'reviewits' ];
    }


    protected function register_controls() {

        $this->start_controls_section(
            'review_image_section',
            [
                'label' => esc_html__(
                    'Review Image',
                    'reviewits'
                ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $field_options =
            ( new rvts_get_review_field_options() )->get();


        $this->add_control(
            'field_id',
            [
                'label' => esc_html__(
                    'Review Field',
                    'reviewits'
                ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => $field_options,
                'default' => '',
            ]
        );


        $this->end_controls_section();
    }
    
    protected function render() {

    $settings = $this->get_settings_for_display();

    $field_id = isset( $settings['field_id'] )
        ? sanitize_key( $settings['field_id'] )
        : '';

    if ( ! $field_id ) {
        return;
    }

    $review_id = rvts_review_context::get();

    if ( ! $review_id ) {
        return;
    }

    $fields = ( new rvts_get_review_fields() )->get(
        $review_id
    );

    if ( empty( $fields ) ) {
        return;
    }

    foreach ( $fields as $field ) {

        if (
            isset( $field['field_id'] ) &&
            $field['field_id'] === $field_id
        ) {

            $field_value = isset( $field['field_value'] )
                ? trim( $field['field_value'] )
                : '';

            if ( ! $field_value ) {
                return;
            }


            /*
             * ==========================================
             * IMAGE VALUE
             * Supports:
             * 1. Attachment ID
             * 2. Image URL
             * ==========================================
             */

            if ( is_numeric( $field_value ) ) {

                $image_url = wp_get_attachment_image_url(
                    absint( $field_value ),
                    'full'
                );

            } else {

                $image_url = esc_url_raw(
                    $field_value
                );
            }


            if ( ! $image_url ) {
                return;
            }


            echo '<img src="' .
                esc_url( $image_url ) .
                '" alt="" />';


            return;
        }
    }
}

    
}