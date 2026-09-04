<?php

class rvts_image_field {

    public function render(array $field) {
        $label = $field['label_type'] ?? '';
        $required = !empty($field['field_required']) ? 'required' : '';

        $field_width = $field['field_width'] ?? '[]';
        $width = $field_width['size'] ?? 100;
        $unit = $field_width['unit'] ?? '%';

        echo '<div class="rvts-form-group" style="width: '. esc_attr($width . $unit) .';">';
        
        echo '<label for="'. esc_attr($label) .'">'.$label.'</label>';
        echo '<input type="file" 
            name="'. esc_attr($label) . '" 
            id="'. esc_attr($label) . '" ' . $required . '>';

        echo '</div>';
    }
}