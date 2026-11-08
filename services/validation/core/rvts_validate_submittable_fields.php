<?php

class rvts_validate_submittable_fields {

    public function validate(
        array $configuration,
        array $submittable_fields,
        array $submitted_fields,
        array $submitted_files
    ) {

        $required_validator = new rvts_validate_required_field();

        foreach ( $configuration as $field_id => $field ) {

            /*
             * Only validate fields that are actually
             * part of the submitted form.
             */
            if ( ! in_array(
                $field_id,
                $submittable_fields,
                true
            ) ) {
                continue;
            }

            $required_fields = [
                $field_id => [
                    'required' => ! empty(
                        $field['required']
                    ),
                    'label' => isset( $field['label'] )
                        ? $field['label']
                        : $field_id,
                ],
            ];

            $required_result =
                $required_validator->validate(
                    (string) $field_id,
                    $required_fields,
                    $submitted_fields,
                    $submitted_files
                );

            if ( is_wp_error( $required_result ) ) {
                return $required_result;
            }
        }

        return true;
    }
}