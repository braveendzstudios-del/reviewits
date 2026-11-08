<?php

class rvts_validate_textarea_field {

    public function validate( string $value ) {

        if ( ! is_string( $value ) ) {
            return new WP_Error(
                'invalid_textarea',
                'Invalid textarea value.'
            );
        }

        return true;
    }
}