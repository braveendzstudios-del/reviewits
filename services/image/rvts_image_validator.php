<?php

class rvts_image_validator {

    /**
     * Validate an uploaded image.
     *
     * @param array $file Uploaded file.
     *
     * @return true|WP_Error
     */
    public function validate( array $file ) {

        /*
         * Upload error
         */
        if (
            ! isset( $file['error'] ) ||
            $file['error'] !== UPLOAD_ERR_OK
        ) {

            return new WP_Error(
                'rvts_image_upload_error',
                'There was a problem uploading the image.'
            );

        }


        /*
         * Check real uploaded file
         */
        if (
            empty( $file['tmp_name'] ) ||
            ! is_uploaded_file( $file['tmp_name'] )
        ) {

            return new WP_Error(
                'rvts_invalid_image',
                'Invalid uploaded file.'
            );

        }


        /*
         * Check real MIME type
         */
        $finfo = finfo_open(
            FILEINFO_MIME_TYPE
        );


        if ( ! $finfo ) {

            return new WP_Error(
                'rvts_mime_check_failed',
                'Unable to verify image type.'
            );

        }


        $real_mime = finfo_file(
            $finfo,
            $file['tmp_name']
        );


        finfo_close( $finfo );


        /*
         * Only images allowed
         */
        if (
            strpos( $real_mime, 'image/' ) !== 0
        ) {

            return new WP_Error(
                'rvts_invalid_image_type',
                'Only image files are allowed.'
            );

        }


        /*
         * Maximum file size: 1 MB
         */
        $max_file_size = 1 * 1024 * 1024;


        if (
            $file['size'] >= $max_file_size
        ) {

            return new WP_Error(
                'rvts_image_too_large',
                'Image must be smaller than 1 MB.'
            );

        }


        /*
         * Validation passed
         */
        return true;
    }

}