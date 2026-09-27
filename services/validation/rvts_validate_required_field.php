<?php

class rvts_validate_required_field {

    public function validate(
        array $configuration,
        array $submitted_fields,
        array $submitted_files
    ) {

        foreach ( $configuration as $field_id => $field ) {

            if ( empty( $field['required'] ) ) {
                continue;
            }

            $has_value = false;

            if ( isset( $submitted_fields[ $field_id ] ) ) {

                $value = $submitted_fields[ $field_id ];

                if ( is_array( $value ) ) {
                    $has_value = ! empty( $value );
                } else {
                    $has_value = '' !== trim( (string) $value );
                }
            }

            if (
                isset( $submitted_files[ $field_id ] ) &&
                ! empty( $submitted_files[ $field_id ]['name'] )
            ) {
                $has_value = true;
            }

            if ( ! $has_value ) {

                $label = ! empty( $field['label'] )
                    ? $field['label']
                    : $field_id;

                return new WP_Error(
                    'required_field',
                    sprintf( '%s is required.', $label )
                );
            }
        }

        return true;
    }
}