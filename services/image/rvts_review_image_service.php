<?php

class rvts_review_image_service {

    /**
     * Image validator.
     *
     * @var rvts_image_validator
     */
    private $validator;


    /**
     * Image uploader.
     *
     * @var rvts_image_uploader
     */
    private $uploader;


    /**
     * Image attachment handler.
     *
     * @var rvts_image_attachment
     */
    private $attachment;


    /**
     * Constructor.
     */
    public function __construct() {

        $this->validator =
            new rvts_image_validator();

        $this->uploader =
            new rvts_image_uploader();

        $this->attachment =
            new rvts_image_attachment();

    }


    /**
     * Process uploaded review images.
     *
     * @param array $submitted_files Uploaded files.
     *
     * @return array|WP_Error
     */
    public function process( array $submitted_files ) {

        $uploaded_image_ids = [];


        foreach (
            $submitted_files as $field_id => $file
        ) {

            /*
             * ==========================================
             * VALIDATE
             * ==========================================
             */

            $validation =
                $this->validator->validate(
                    $file
                );


            if (
                is_wp_error(
                    $validation
                )
            ) {

                return $validation;

            }


            /*
             * ==========================================
             * UPLOAD
             * ==========================================
             */

            $upload =
                $this->uploader->upload(
                    $file
                );


            if (
                is_wp_error(
                    $upload
                )
            ) {

                return $upload;

            }


            /*
             * ==========================================
             * CREATE ATTACHMENT
             * ==========================================
             */

            $attachment_id =
                $this->attachment->create(
                    $upload,
                    $file['name']
                );


            if (
                is_wp_error(
                    $attachment_id
                )
            ) {

                return $attachment_id;

            }


            /*
             * ==========================================
             * STORE ATTACHMENT ID
             * ==========================================
             */

            $uploaded_image_ids[
                sanitize_key( $field_id )
            ] = $attachment_id;

        }


        return $uploaded_image_ids;

    }

}