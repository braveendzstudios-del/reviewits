<?php

class rvts_review_heading extends \Elementor\Widget_Base {

    public function get_name() {

        return 'rvts_review_heading';
    }


    public function get_title() {

        return esc_html__(
            'Review Heading',
            'reviewits'
        );
    }


    public function get_icon() {

        return 'eicon-heading';
    }


    public function get_categories() {

        return [ 'reviewits' ];
    }


    protected function register_controls() {

        /*
         * ==========================================
         * CONTENT
         * ==========================================
         */

        $this->start_controls_section(
            'review_heading_section',
            [
                'label' => esc_html__(
                    'Review Heading',
                    'reviewits'
                ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        /*
         * ------------------------------------------
         * REVIEW FIELD
         * ------------------------------------------
         */

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


        /*
         * ------------------------------------------
         * CHARACTER LIMIT
         * ------------------------------------------
         */

        ( new rvts_review_heading_character_limit_control() )->register(
            $this
        );

        ( new rvts_review_heading_tag_control() )->register(
            $this
        );


        $this->end_controls_section();


        /*
         * ==========================================
         * STYLE CONTROLS
         * ==========================================
         */

        ( new rvts_review_heading_color_control() )->register(
            $this
        );


        ( new rvts_review_heading_typography_control() )->register(
            $this
        );


        ( new rvts_review_heading_alignment_control() )->register(
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
         *
         * When editing the Review Loop Item directly,
         * there may be no review context.
         *
         * In that case, use the first saved review
         * only for the Elementor preview.
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

                /*
                 * ----------------------------------
                 * FIELD VALUE
                 * ----------------------------------
                 */

                $heading = isset(
                    $field['field_value']
                )
                    ? (string) $field['field_value']
                    : '';


                /*
                 * ----------------------------------
                 * CHARACTER LIMIT
                 * ----------------------------------
                 */

                $character_limit = isset(
                    $settings['character_limit']
                )
                    ? absint(
                        $settings['character_limit']
                    )
                    : 30;


                if ( $character_limit > 0 ) {

                    $heading = (
                        new rvts_review_heading_clamp()
                    )->clamp(
                        $heading,
                        $character_limit
                    );
                }


                /*
                 * ----------------------------------
                 * OUTPUT
                 * ----------------------------------
                 */

                echo '<div class="rvts-review-heading">';

                echo esc_html(
                    $heading
                );

                echo '</div>';


                return;
            }
        }
    }
}