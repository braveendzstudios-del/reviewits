<?php

class rvts_get_review_text {

    public function get(
        array $field_types,
        array $submitted_fields
    ) {

        foreach (
            $field_types as $field_id => $field_type
        ) {

            if (
                'textarea' === $field_type &&
                isset( $submitted_fields[ $field_id ] )
            ) {
                return sanitize_textarea_field(
                    $submitted_fields[ $field_id ]
                );
            }
        }

        return '';
    }
}