<?php

class rvts_image_uploader {

    /**
     * Upload an image to WordPress.
     *
     * @param array $file Uploaded file.
     *
     * @return array|WP_Error
     */
    public function upload( array $file ) {

        /*
         * Load WordPress upload functions.
         */

        require_once ABSPATH .
            'wp-admin/includes/file.php';


        /*
         * Upload file.
         */

        $upload = wp_handle_upload(
            $file,
            [
                'test_form' => false,
            ]
        );


        /*
         * Check upload error.
         */

        if (
            isset( $upload['error'] )
        ) {

            return new WP_Error(
                'rvts_image_upload_failed',
                'Image upload failed.'
            );

        }


        /*
         * Return upload information.
         */

        return $upload;

    }

}