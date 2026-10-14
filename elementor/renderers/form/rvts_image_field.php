
<?php
if ( ! defined( 'ABSPATH' ) ) exit;
class rvts_image_field {

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

        echo '<input type="file"
            name="' . esc_attr( $field_id ) . '"
            id="' . esc_attr( $field_id ) . '"
            accept="image/*"'
            . ( ! empty( $field['field_required'] ) ? ' required' : '' )
            . '>';

        echo '</div>';
    }
}
