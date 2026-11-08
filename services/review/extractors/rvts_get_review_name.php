<?php

class rvts_get_review_name {

    public function get(
        array $field_types,
        array $submitted_fields
    ) {

        foreach (
            $field_types as $field_id => $field_type
        ) {

            if (
                'text' === $field_type &&
                isset( $submitted_fields[ $field_id ] )
            ) {
                return sanitize_text_field(
                    $submitted_fields[ $field_id ]
                );
            }
        }

        return '';
    }
}