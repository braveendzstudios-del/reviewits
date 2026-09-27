<?php

class rvts_get_submitted_fields {

    public function get() {

        $submitted_fields = [];

        foreach ( $_POST as $field_id => $value ) {

            if (
                in_array(
                    $field_id,
                    [
                        'action',
                        'nonce',
                        'rvts_field_types',
                        'rvts_field_configuration',
                    ],
                    true
                )
            ) {
                continue;
            }

            $clean_field_id = sanitize_key( $field_id );

            if ( is_array( $value ) ) {

                $submitted_fields[ $clean_field_id ] =
                    array_map(
                        'sanitize_text_field',
                        wp_unslash( $value )
                    );

            } else {

                $submitted_fields[ $clean_field_id ] =
                    sanitize_textarea_field(
                        wp_unslash( $value )
                    );
            }
        }

        return $submitted_fields;
    }
}