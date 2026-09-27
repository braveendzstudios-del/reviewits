<?php

class rvts_validate_email_field {

    public function validate( string $value ) {

        if ( ! is_string( $value ) || ! is_email( $value ) ) {
            return new WP_Error(
                'invalid_email',
                'Please enter a valid email address.'
            );
        }

        return true;
    }
}