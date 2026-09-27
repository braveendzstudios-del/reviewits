<?php
class rvts_textarea_field {

    public function render(array $field) {
        $label = $field['label_type'] ?? '';
        $field_id    = $field['field_id'] ?? '';
        $placeholder = $field['placeholder'] ?? '';
        $required = !empty($field['field_required']) ? 'required' : '';

        $field_width = $field['field_width'] ?? '[]';
        $width = $field_width['size'] ?? 100;
        $unit = $field_width['unit'] ?? '%';

        echo '<div class="rvts-form-group" style="width: '. esc_attr($width . $unit) .';">';
        echo '<label for="'. esc_attr($label) .'">'.$label.'</label>';
        echo '<textarea 
            name="'. esc_attr($field_id) . '" 
            id="'. esc_attr($field_id) . '" 
            placeholder="' . esc_attr($placeholder) . '" ' . $required . '></textarea>';

        echo '</div>';
    }
}