<?php

class rvts_get_review_email {

    public function get(
        array $field_types,
        array $submitted_fields
    ) {

        foreach (
            $field_types as $field_id => $field_type
        ) {

            if (
                'email' === $field_type &&
                isset( $submitted_fields[ $field_id ] )
            ) {
                return sanitize_email(
                    $submitted_fields[ $field_id ]
                );
            }
        }

        return '';
    }
}