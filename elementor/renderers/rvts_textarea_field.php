<?php
class rvts_textarea_field {

    public function render(array $field) {
        $label = $field['label_type'] ?? '';
        $placeholder = $field['placeholder'] ?? '';
        $required = !empty($field['field_required']) ? 'required' : '';

        echo '<div class="rvts-form-group">';
        
        echo '<label for="'. esc_attr($label) .'">'.$label.'</label>';
        echo '<textarea 
            name="'. esc_attr($label) . '" 
            id="'. esc_attr($label) . '" 
            placeholder="' . esc_attr($placeholder) . '" ' . $required . '></textarea>';

        echo '</div>';
    }
}