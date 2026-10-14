
<?php
if ( ! defined( 'ABSPATH' ) ) exit;
class rvts_rating_field {

    public function render( array $field ) {

        $label    = $field['label_type'] ?? '';
        $field_id = isset( $field['field_id'] )
            ? sanitize_key( trim( $field['field_id'] ) )
            : '';

        $field_width = $field['field_width'] ?? [];
        $width       = $field_width['size'] ?? 100;
        $unit        = $field_width['unit'] ?? '%';

        echo '<div class="rvts-form-group" style="width: ' .
            esc_attr( $width . $unit ) . ';">';

        echo '<label for="' . esc_attr( $field_id ) . '">' .
            esc_html( $label ) . '</label>';

        $star = ! empty( $field['rating'] )
            ? absint( $field['rating'] )
            : 5;

        // Keep the rating within the supported 1–5 range.
        $star = min( 5, max( 1, $star ) );

        $active_star = ! empty( $field['active_star']['url'] )
            ? $field['active_star']['url']
            : plugins_url( '../assets/star-active.svg', __FILE__ );

        $inactive_star = ! empty( $field['inactive_star']['url'] )
            ? $field['inactive_star']['url']
            : plugins_url( '../assets/star-inactive.svg', __FILE__ );

        echo '<div class="rvts-rating"
            data-active-star="' . esc_url( $active_star ) . '"
            data-inactive-star="' . esc_url( $inactive_star ) . '">';

        for ( $i = 1; $i <= $star; $i++ ) {

            echo '<img
                src="' . esc_url( $inactive_star ) . '"
                data-active-src="' . esc_url( $active_star ) . '"
                data-inactive-src="' . esc_url( $inactive_star ) . '"
                alt="' . esc_attr__( 'Star', 'reviewits' ) . '"
                class="rvts-star"
                data-rating="' . esc_attr( $i ) . '"
            />';
        }

        echo '</div>';

        echo '<input type="hidden"
            name="' . esc_attr( $field_id ) . '"
            id="' . esc_attr( $field_id ) . '"
            class="rvts-rating-value"
            value="0" />';

        echo '</div>';
    }
}
