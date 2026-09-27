<?php

class rvts_get_field_configuration {

    public function get( array $fields ) {

        $configuration = [];

        foreach ( $fields as $field ) {

            $field_id = sanitize_key(
                $field['field_id'] ?? ''
            );

            if ( empty( $field_id ) ) {
                continue;
            }

            $configuration[ $field_id ] = [
                'field_type' => sanitize_key(
                    $field['field_type'] ?? ''
                ),

                'required' => ! empty(
                    $field['field_required']
                ),

                'rating' => isset( $field['rating'] )
                    ? absint( $field['rating'] )
                    : 0,

                'label' => sanitize_text_field(
                    $field['label_type'] ?? ''
                ),
            ];
        }

        return $configuration;
    }
}