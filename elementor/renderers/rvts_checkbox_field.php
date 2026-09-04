<?php
class rvts_checkbox_field {

    public function render(array $field) {
        $label = $field['label_type'] ?? '';
        $required = !empty($field['field_required']) ? 'required' : '';

        $field_width = $field['field_width'] ?? '[]';
        $width = $field_width['size'] ?? 100;
        $unit = $field_width['unit'] ?? '%';

        echo '<div class="rvts-form-group" style="width: '. esc_attr($width . $unit) .';">';
        echo '<label class="rvts-checkbox-label" for="'. esc_attr($label) .'">';

        echo '<input type="checkbox" 
        name="' . esc_attr($label) . '" ' 
        . esc_attr($required) . ' value="1" />';
        echo '<span>' . esc_html($label) . '</span>';

        echo '</label>';

        echo '</div>';
    }
}