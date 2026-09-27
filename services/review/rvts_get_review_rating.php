<?php

class rvts_get_review_rating {

    public function get(
        array $field_types,
        array $submitted_fields
    ) {

        foreach (
            $field_types as $field_id => $field_type
        ) {

            if (
                'rating' === $field_type &&
                isset( $submitted_fields[ $field_id ] )
            ) {
                return absint(
                    $submitted_fields[ $field_id ]
                );
            }
        }

        return 0;
    }
}