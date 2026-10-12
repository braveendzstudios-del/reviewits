
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

        ( new rvts_review_image_alignment_control() )->register( $this );

        $this->end_controls_section();

        // Separate image styling controls here

        ( new rvts_review_image_width_control() )->register( $this );
        ( new rvts_review_image_height_control() )->register( $this );
        ( new rvts_review_image_object_fit_control() )->register( $this );
        ( new rvts_review_image_border_radius_control() )->register( $this );
        ( new rvts_review_image_border_control() )->register( $this );
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        $field_id = isset( $settings['field_id'] )
            ? sanitize_key( $settings['field_id'] )
            : '';

        if ( ! $field_id ) {
            return;
        }

        /*
         * Get the review currently being rendered.
         */
        $review_id = rvts_review_context::get();

        /*
         * Elementor editor preview fallback.
         * When no review context exists, use the latest
         * approved review that has the selected image field.
         */
        if (
            ! $review_id &&
            class_exists( '\Elementor\Plugin' ) &&
            \Elementor\Plugin::$instance->editor->is_edit_mode()
        ) {

            $latest_image = (
                new rvts_get_latest_review_image()
            )->get( $field_id );

            if ( ! empty( $latest_image['image_url'] ) ) {

                echo '<img
                    src="' . esc_url( $latest_image['image_url'] ) . '"
                    alt=""
                    class="rvts-review-image"
                />';

            }

            return;
        }

        /*
         * On the published review loop, use the image
         * belonging to the current review.
         */
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
                ! isset( $field['field_id'] ) ||
                sanitize_key( $field['field_id'] ) !== $field_id
            ) {
                continue;
            }

            // Only render image fields.
            if (
                isset( $field['field_type'] ) &&
                'image' !== $field['field_type']
            ) {
                return;
            }

            $field_value = isset( $field['field_value'] )
                ? trim( (string) $field['field_value'] )
                : '';

            if ( '' === $field_value ) {
                return;
            }

            /*
             * Support WordPress attachment IDs and image URLs.
             */
            if ( is_numeric( $field_value ) ) {

                $image_url = wp_get_attachment_image_url(
                    absint( $field_value ),
                    'full'
                );

            } else {

                $image_url = esc_url_raw( $field_value );
            }

            if ( ! $image_url ) {
                return;
            }

            echo '<img
                src="' . esc_url( $image_url ) . '"
                alt=""
                class="rvts-review-image"
            />';

            return;
        }
    }
}
