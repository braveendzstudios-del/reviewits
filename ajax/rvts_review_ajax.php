<?php

class rvts_review_ajax {

    public function __construct() {

        add_action(
            'wp_ajax_rvts_submit_review',
            [ $this, 'submit_review' ]
        );

        add_action(
            'wp_ajax_nopriv_rvts_submit_review',
            [ $this, 'submit_review' ]
        );

    }


    public function submit_review() {

        /*
         * =========================================================
         * SECURITY CHECK
         * =========================================================
         */

        if (
            ! check_ajax_referer(
                'rvts_submit_review',
                'nonce',
                false
            )
        ) {

            wp_send_json_error([
                'message' => 'Security check failed.',
            ]);

        }


        /*
         * =========================================================
         * GET FIELD TYPES
         * =========================================================
         */

        $field_types = (
            new rvts_get_field_types()
        )->get();


        /*
         * =========================================================
         * GET SUBMITTED FIELDS
         * =========================================================
         */

        $submitted_fields = (
            new rvts_get_submitted_fields()
        )->get();


        /*
         * =========================================================
         * GET SUBMITTED FILES
         * =========================================================
         */

        $submitted_files = (
            new rvts_get_submitted_files()
        )->get();


        /*
         * =========================================================
         * GET FIELD CONFIGURATION
         * =========================================================
         */

        $configuration = (
            new rvts_get_submitted_configuration()
        )->get();


        /*
         * =========================================================
         * CHECK SUBMISSION DATA
         * =========================================================
         */

        $has_data = (
            new rvts_check_submission_data()
        )->check(
            $submitted_fields,
            $submitted_files
        );


        if ( ! $has_data ) {

            wp_send_json_error([
                'message' => 'No review data was submitted.',
            ]);

        }


        /*
         * =========================================================
         * GET SUBMITTABLE FIELDS
         * =========================================================
         */

        $submittable_fields = (
            new rvts_get_submittable_fields()
        )->get(
            $configuration,
            $submitted_fields,
            $submitted_files
        );


        /*
         * =========================================================
         * VALIDATE SUBMITTABLE FIELDS
         * =========================================================
         */

        $validation = (
            new rvts_validate_submittable_fields()
        )->validate(
            $configuration,
            $submittable_fields,
            $submitted_fields,
            $submitted_files
        );


        /*
         * =========================================================
         * VALIDATION ERROR
         * =========================================================
         */

        if ( is_wp_error( $validation ) ) {

            wp_send_json_error([
                'message' => $validation->get_error_message(),
            ]);

        }


            /*
    * =========================================================
    * CREATE PARENT REVIEW
    * =========================================================
    */

    $review_id = (
        new rvts_save_review()
    )->save();


    if ( is_wp_error( $review_id ) ) {

        wp_send_json_error([
            'message' => $review_id->get_error_message(),
        ]);

    }


    /*
    * =========================================================
    * SAVE DYNAMIC FIELDS
    * =========================================================
    */

    /*
    * =========================================================
    * PROCESS SUBMITTED IMAGES
    * =========================================================
    */

    $uploaded_image_ids = (
        new rvts_review_image_service()
    )->process(
        $submitted_files
    );


    if ( is_wp_error( $uploaded_image_ids ) ) {

        wp_send_json_error([
            'message' => $uploaded_image_ids->get_error_message(),
        ]);

    }


    $field_save_result = (
        new rvts_save_submittable_fields()
    )->save(
        $review_id,
        $submittable_fields,
        $uploaded_image_ids
    );


    if ( is_wp_error( $field_save_result ) ) {

        wp_send_json_error([
            'message' => $field_save_result->get_error_message(),
        ]);

    }


    /*
    * =========================================================
    * SUCCESS
    * =========================================================
    */

        wp_send_json_success([

            'message' => 'Review submitted successfully.',

            'review_id' => $review_id,

        ]);

    }

}