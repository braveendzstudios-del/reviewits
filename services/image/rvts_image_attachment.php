<?php

class rvts_image_attachment {

    /**
     * Create a WordPress Media Library attachment.
     *
     * @param array  $upload Uploaded file data.
     * @param string $name   Original file name.
     *
     * @return int|WP_Error
     */
    public function create( array $upload, string $name = '' ) {

        /*
         * Create attachment data.
         */

        $attachment = [

            'post_mime_type' =>
                $upload['type'],

            'post_title' =>
                sanitize_file_name(
                    pathinfo(
                        $name,
                        PATHINFO_FILENAME
                    )
                ),

            'post_content' => '',

            'post_status' => 'inherit',

        ];


        /*
         * Insert attachment into Media Library.
         */

        $attachment_id =
            wp_insert_attachment(
                $attachment,
                $upload['file']
            );


        if (
            is_wp_error(
                $attachment_id
            )
        ) {

            return new WP_Error(
                'rvts_attachment_failed',
                'Could not add image to Media Library.'
            );

        }


        /*
         * Generate image metadata.
         */

        $attachment_metadata =
            wp_generate_attachment_metadata(
                $attachment_id,
                $upload['file']
            );


        /*
         * Save image metadata.
         */

        wp_update_attachment_metadata(
            $attachment_id,
            $attachment_metadata
        );


        /*
         * Return attachment ID.
         */

        return $attachment_id;

    }

}