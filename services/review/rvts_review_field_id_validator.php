<?php

class rvts_review_field_id_validator {

    public function validate( array $fields ) {

        $used_ids = [];
        $errors   = [];

        foreach ( $fields as $index => $field ) {

            $field_id = isset( $field['field_id'] )
                ? sanitize_key( $field['field_id'] )
                : '';

            if ( ! $field_id ) {
                continue;
            }

            if ( isset( $used_ids[ $field_id ] ) ) {

                $errors[] = [
                    'field_id' => $field_id,
                    'index'    => $index,
                    'message'  => sprintf(
                        esc_html__(
                            'Field ID "%s" is already used in this form.',
                            'reviewits'
                        ),
                        $field_id
                    ),
                ];

                continue;
            }

            $used_ids[ $field_id ] = true;
        }

        return $errors;
    }

    public function test() {

        $fields = [
            [
                'field_id' => 'name',
            ],
            [
                'field_id' => 'email',
            ],
            [
                'field_id' => 'name',
            ],
        ];

        return $this->validate( $fields );
    }
}