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

        ( new rvts_review_text_character_limit_control() )->register(
            $this
        );
        
        //button control
        ( new rvts_review_text_read_more_control() )->register(
            $this
        );

        ( new rvts_review_text_read_less_control() )->register(
            $this
        );


        $this->end_controls_section();
        
        ( new rvts_review_text_color_control() )->register(
            $this
        );

        ( new rvts_review_text_typography_control() )->register(
            $this
        );

        ( new rvts_review_text_alignment_control() )->register(
            $this
        );

        ( new rvts_review_text_toggle_color_control() )->register(
            $this
        );

        ( new rvts_review_text_toggle_typography_control() )->register(
            $this
        );

        ( new rvts_review_text_toggle_margin_control() )->register(
            $this
        );

        
    }


    protected function render() {

        $settings = $this->get_settings_for_display();


        /*
         * ==========================================
         * GET FIELD ID
         * ==========================================
         */

        $field_id = isset( $settings['field_id'] )
            ? sanitize_key(
                trim( $settings['field_id'] )
            )
            : '';


        if ( ! $field_id ) {

            return;
        }


        /*
         * ==========================================
         * GET CURRENT REVIEW
         * ==========================================
         */

        $review_id = rvts_review_context::get();


        /*
         * ==========================================
         * EDITOR PREVIEW
         * ==========================================
         */

        if (
            ! $review_id &&
            \Elementor\Plugin::instance()->editor->is_edit_mode()
        ) {

            $preview_reviews = (
                new rvts_get_reviews()
            )->get([
                'limit'  => 1,
                'offset' => 0,
            ]);


            if (
                ! empty( $preview_reviews[0]['id'] )
            ) {

                $review_id = absint(
                    $preview_reviews[0]['id']
                );
            }
        }


        if ( ! $review_id ) {

            return;
        }


        /*
         * ==========================================
         * GET REVIEW FIELDS
         * ==========================================
         */

        $fields = (
            new rvts_get_review_fields()
        )->get(
            $review_id
        );


        if ( empty( $fields ) ) {

            return;
        }


        /*
         * ==========================================
         * FIND SELECTED FIELD
         * ==========================================
         */

        foreach ( $fields as $field ) {

            if (
                isset( $field['field_id'] ) &&
                sanitize_key(
                    trim( $field['field_id'] )
                ) === $field_id
            ) {

                $text = isset(
                    $field['field_value']
                )
                    ? (string) $field['field_value']
                    : '';

                        $character_limit = isset(
                $settings['character_limit']
                )
                    ? absint( $settings['character_limit'] )
                    : 30;

                $read_more_text = isset(
                    $settings['read_more_text']
                )
                    ? (string) $settings['read_more_text']
                    : 'Read More';

                $read_less_text = isset(
                    $settings['read_less_text']
                )
                    ? (string) $settings['read_less_text']
                    : 'Read Less';


                /*
                 * ----------------------------------
                 * OUTPUT
                 * ----------------------------------
                 */

                echo '<div class="rvts-review-text">';

                ( new rvts_review_text_read_more() )->render(
                    $text,
                    $character_limit,
                    $read_more_text,
                    $read_less_text
                );

                echo '</div>';


                return;
            }
        }
    }
}