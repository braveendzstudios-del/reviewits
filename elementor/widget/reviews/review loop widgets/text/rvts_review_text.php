<?php

class rvts_review_text extends \Elementor\Widget_Base {

    public function get_name() {

        return 'rvts_review_text';
    }

    public function get_title() {

        return esc_html__(
            'Review Text',
            'reviewits'
        );
    }

    public function get_icon() {

        return 'eicon-text';
    }

    public function get_categories() {

        return [ 'reviewits' ];
    }


    protected function register_controls() {

        $this->start_controls_section(
            'review_text_section',
            [
                'label' => esc_html__(
                    'Review Text',
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

                echo wp_kses_post(
                    nl2br(
                        esc_html(
                            $field['field_value']
                        )
                    )
                );

                return;
            }
        }
    }
}