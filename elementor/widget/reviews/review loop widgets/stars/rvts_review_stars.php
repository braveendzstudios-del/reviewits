
<?php

class rvts_review_stars extends \Elementor\Widget_Base {

    public function get_name() {
        return 'rvts_review_stars';
    }

    public function get_title() {
        return esc_html__(
            'Review Stars',
            'reviewits'
        );
    }

    public function get_icon() {
        return 'eicon-star';
    }

    public function get_categories() {
        return [ 'reviewits' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'review_stars_section',
            [
                'label' => esc_html__(
                    'Review Stars',
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

        ( new rvts_review_stars_rated_svg_control() )->register(
            $this
        );

        ( new rvts_review_stars_unrated_svg_control() )->register(
            $this
        );


        $this->end_controls_section();

        ( new rvts_review_stars_style_control() )->register( $this );
        ( new rvts_review_stars_spacing_control() )->register( $this );
        ( new rvts_review_stars_alignment_control() )->register( $this );
        
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

        /*
        * Elementor editor preview fallback.
        * Use the latest review when no review context exists.
        */
        if (
            ! $review_id &&
            \Elementor\Plugin::$instance->editor->is_edit_mode()
        ) {
            $preview_reviews = ( new rvts_get_reviews() )->get( [
                'limit'  => 1,
                'offset' => 0,
            ] );

            if ( ! empty( $preview_reviews[0]['id'] ) ) {
                $review_id = absint( $preview_reviews[0]['id'] );
            }
        }

        if ( ! $review_id ) {
            return;
        }

        $fields = ( new rvts_get_review_fields() )->get( $review_id );

        if ( ! empty( $settings['form_id'] ) ) {
            // Leave empty for now; this widget does not currently define form_id.
        }

        foreach ( $fields as $field ) {

            if (
                isset( $field['field_id'] ) &&
                sanitize_key( $field['field_id'] ) === $field_id
            ) {

            $rating = absint( $field['field_value'] ?? 0 );

            $max_stars = isset( $field['max_stars'] )
                ? absint( $field['max_stars'] )
                : 0;

            /*
            * Fallback for older records or non-rating fields.
            */
            if ( $max_stars < 1 ) {
                $max_stars = 5;
            }

            $max_stars = max( 1, min( 10, $max_stars ) );

            $rating = min( $rating, $max_stars );

            $rated_svg = ! empty( $settings['rated_star_svg']['url'] )
                ? $settings['rated_star_svg']['url']
                : '';

            $unrated_svg = ! empty( $settings['unrated_star_svg']['url'] )
                ? $settings['unrated_star_svg']['url']
                : '';

        /*
        * Convert relative SVG paths to full URLs.
        * Leave existing full URLs unchanged.
        */
        if ( $rated_svg && ! preg_match( '#^https?://#i', $rated_svg ) ) {
            $rated_svg = content_url(
                ltrim( str_replace( 'reviewits/', 'plugins/reviewits/', $rated_svg ), '/' )
            );
        }

        if ( $unrated_svg && ! preg_match( '#^https?://#i', $unrated_svg ) ) {
            $unrated_svg = content_url(
                ltrim( str_replace( 'reviewits/', 'plugins/reviewits/', $unrated_svg ), '/' )
            );
        }


        echo '<div class="rvts-review-stars" style="display:flex;">';

        for ( $i = 1; $i <= $max_stars; $i++ ) {

            $star_url = ( $i <= $rating )
                ? $rated_svg
                : $unrated_svg;

            if ( ! empty( $star_url ) ) {
                echo '<img
                    src="' . esc_url( $star_url ) . '"
                    alt="' . esc_attr( $i <= $rating ? 'Rated star' : 'Unrated star' ) . '"
                    class="rvts-review-star"
                />';
            }
        }

        echo '</div>';


                    return;
                }
            }
    }

}
