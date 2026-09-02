<?php

class rvts_rating_field {

    public function render(array $field) {
        $label = $field['label_type'] ?? '';


        echo '<label>' . esc_html($label) . '</label>';
            $star = !empty($field['rating']) ?(int) $field ['rating']:5;
            
            $active_star = !empty($field['active_star']['url']) ? 
            $field['active_star']['url'] : plugins_url( '../assets/star-active.svg', __FILE__);

            $inactive_star = !empty($field['inactive_star']['url']) ? 
            $field['inactive_star']['url'] : plugins_url( '../assets/star-inactive.svg', __FILE__);

            echo '<div class="rvts-rating" data-active-star="'.esc_url($active_star).'"
            data-inactive-star="'.esc_url($inactive_star).'">';
                
                for($i = 1; $i <= $star; $i++) {
                    echo'<img src=" '.esc_url($inactive_star).' "
                    data-active-src="'.esc_url($active_star).'"
                    data-inactive-src="'.esc_url($inactive_star).'"
                    alt="star" 
                    class="rvts-star"
                    data-rating= "'. esc_attr($i) . '"
                    />';
                
                }

        echo'</div>';

        echo '<input type="hidden" name="' . esc_attr($label) . '" value="0" />';
    }
}