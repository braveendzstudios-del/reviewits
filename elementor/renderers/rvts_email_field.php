<?php
class rvts_email_field {   
    public function render(array $field) {
        $label = $field['label_type'] ?? '';
        $placeholder = $field['placeholder'] ?? '';
        $required = !empty($field['field_required']) ? 'required' : '';

        $field_width = $field['field_width'] ?? '[]';
        $width = $field_width['size'] ?? 100;
        $unit = $field_width['unit'] ?? '%';

        echo'<div class="rvts-form-group" style="width: '. esc_attr($width . $unit) .';">';
        
        echo'<label for="'. esc_attr($label) .'">'.$label.'</label>';
        echo'<input type="email" 
        name="'. esc_attr($label) . '" 
        id="'. esc_attr($label) . '" 
        placeholder="' . esc_attr($placeholder) . '" ' . $required . '>';

        echo'</div>';
    }
}