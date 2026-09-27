<?php

class rvts_validate_image_field {

    public function validate( array $file ) {

        if (
            empty( $file['name'] ) ||
            empty( $file['tmp_name'] )
        ) {
            return new WP_Error(
                'invalid_image',
                'Please upload a valid image.'
            );
        }

        return true;
    }
}