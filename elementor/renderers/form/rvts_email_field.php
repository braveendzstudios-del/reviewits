
<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class rvts_email_field {

    public function render( array $field ) {

        $label       = $field['label_type'] ?? '';
        $placeholder = $field['placeholder'] ?? '';
        $field_id    = $field['field_id'] ?? '';

        $field_width = $field['field_width'] ?? [];
        $width       = $field_width['size'] ?? 100;
        $unit        = $field_width['unit'] ?? '%';

        echo '<div class="rvts-form-group" style="width: ' . esc_attr( $width . $unit ) . ';">';

        echo '<label for="' . esc_attr( $field_id ) . '">' . esc_html( $label ) . '</label>';

        echo '<input type="email"
            name="' . esc_attr( $field_id ) . '"
            id="' . esc_attr( $field_id ) . '"
            placeholder="' . esc_attr( $placeholder ) . '"'
            . ( ! empty( $field['field_required'] ) ? ' required' : '' )
            . '>';

        echo '</div>';
    }
}
