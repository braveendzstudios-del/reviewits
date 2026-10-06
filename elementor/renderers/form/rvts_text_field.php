<?php

class rvts_text_field {

    public function render( array $field ) {

        $label = $field['label_type'] ?? '';
        $placeholder = $field['placeholder'] ?? '';
        $required = ! empty( $field['field_required'] )
            ? 'required'
            : '';

        $field_id = isset( $field['field_id'] )
            ? sanitize_key( trim( $field['field_id'] ) )
            : '';

        $field_width = $field['field_width'] ?? [];
        $width = $field_width['size'] ?? 100;
        $unit = $field_width['unit'] ?? '%';

        echo '<div class="rvts-form-group" style="width: ' .
            esc_attr( $width . $unit ) . ';">';

        echo '<label for="' .
            esc_attr( $field_id ) .
            '">' .
            esc_html( $label ) .
            '</label>';

        echo '<input type="text"
            name="' . esc_attr( $field_id ) . '"
            id="' . esc_attr( $field_id ) . '"
            placeholder="' . esc_attr( $placeholder ) . '"
            ' . $required . '>';

        echo '</div>';
    }
}