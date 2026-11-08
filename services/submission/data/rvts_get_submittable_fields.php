<?php

class rvts_get_submittable_fields {

    public function get(
        array $configuration,
        array $submitted_fields,
        array $submitted_files
    ) {

        $fields = [];

        foreach ( $configuration as $field_id => $field ) {

            $field_type = $field['field_type'] ?? '';

            if ( 'image' === $field_type ) {

                if (
                    isset( $submitted_files[ $field_id ] )
                ) {
                    $fields[ $field_id ] = [
                        'configuration' => $field,
                        'value'         => $submitted_files[ $field_id ],
                    ];
                }

                continue;
            }

            if (
                isset( $submitted_fields[ $field_id ] )
            ) {
                $fields[ $field_id ] = [
                    'configuration' => $field,
                    'value'         => $submitted_fields[ $field_id ],
                ];
            }
        }

        return $fields;
    }
}