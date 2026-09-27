<?php

class rvts_validate_required_field {

    public function validate(
        string $field_id,
        array $required_fields,
        array $submitted_fields,
        array $submitted_files
    ) {

        /*
         * Field is not required.
         */
        if (
            empty( $required_fields[ $field_id ] )
        ) {
            return true;
        }

        $has_value = false;

        /*
         * Check submitted normal fields.
         */
        if (
            isset( $submitted_fields[ $field_id ] )
        ) {

            $value = $submitted_fields[ $field_id ];

            if ( is_array( $value ) ) {

                $has_value = ! empty( $value );

            } else {

                $has_value = '' !== trim( (string) $value );

            }
        }

        /*
         * Check submitted files.
         */
        if (
            isset( $submitted_files[ $field_id ] ) &&
            is_array( $submitted_files[ $field_id ] ) &&
            ! empty( $submitted_files[ $field_id ]['name'] )
        ) {

            $has_value = true;

        }

        /*
         * Required field is empty.
         */
        if ( ! $has_value ) {

            return new WP_Error(
                'required_field',
                sprintf(
                    '%s is required.',
                    $field_id
                )
            );

        }

        return true;
    }
}