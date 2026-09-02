<?php
class rvts_checkbox_field {

    public function render(array $field) {
        $label = $field['label_type'] ?? '';
        $required = !empty($field['field_required']) ? 'required' : '';

        echo '<div class="rvts-form-group">';
        echo '<label class="rvts-checkbox-label" for="'. esc_attr($label) .'">';

        echo '<input type="checkbox" 
        name="' . esc_attr($label) . '" ' 
        . esc_attr($required) . ' value="1" />';
        echo '<span>' . esc_html($label) . '</span>';

        echo '</label>';

        echo '</div>';
    }
}