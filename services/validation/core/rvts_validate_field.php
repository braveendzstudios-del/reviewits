<?php

class rvts_validate_field {

    public function validate(
        string $field_id,
        array $field,
        $value
    ) {

        $field_type = $field['field_type'] ?? '';

        switch ( $field_type ) {

            case 'text':

                return ( new rvts_validate_text_field() )
                    ->validate( (string) $value );

            case 'email':

                return ( new rvts_validate_email_field() )
                    ->validate( (string) $value );

            case 'textarea':

                return ( new rvts_validate_textarea_field() )
                    ->validate( (string) $value );

            case 'rating':

                $maximum = absint(
                    $field['rating'] ?? 0
                );

                return ( new rvts_validate_rating_field() )
                    ->validate(
                        absint( $value ),
                        $maximum
                    );

            case 'image':

                return ( new rvts_validate_image_field() )
                    ->validate( $value );

            default:

                return true;
        }
    }
}