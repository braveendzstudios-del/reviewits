<?php

class rvts_validate_text_field {

    public function validate( string $value ) {

        if ( ! is_string( $value ) ) {
            return new WP_Error(
                'invalid_text',
                'Invalid text value.'
            );
        }

        return true;
    }
}