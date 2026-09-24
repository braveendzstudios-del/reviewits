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
         * ==========================================
         * SECURITY CHECK
         * ==========================================
         */

        if ( ! check_ajax_referer( 'rvts_submit_review', 'nonce', false ) ) {

            wp_send_json_error([
                'message' => 'Security check failed.'
            ]);

        }


        /*
         * ==========================================
         * GET & SANITIZE FORM DATA
         * ==========================================
         */

        $name = isset( $_POST['Name'] )
            ? sanitize_text_field(
                wp_unslash( $_POST['Name'] )
            )
            : '';

        $email = isset( $_POST['Email'] )
            ? sanitize_email(
                wp_unslash( $_POST['Email'] )
            )
            : '';

        $review = isset( $_POST['Review'] )
            ? sanitize_textarea_field(
                wp_unslash( $_POST['Review'] )
            )
            : '';

        $rating = isset( $_POST['Rating'] )
            ? absint( $_POST['Rating'] )
            : 0;


        /*
         * ==========================================
         * VALIDATE NAME
         * ==========================================
         */

        if ( empty( $name ) ) {

            wp_send_json_error([
                'message' => 'Name is required.'
            ]);

        }


        /*
         * ==========================================
         * VALIDATE EMAIL
         * ==========================================
         */

        if ( empty( $email ) || ! is_email( $email ) ) {

            wp_send_json_error([
                'message' => 'Please enter a valid email address.'
            ]);

        }


        /*
         * ==========================================
         * VALIDATE REVIEW
         * ==========================================
         */

        if ( empty( $review ) ) {

            wp_send_json_error([
                'message' => 'Review is required.'
            ]);

        }


        /*
         * ==========================================
         * VALIDATE RATING
         * ==========================================
         */

        if ( $rating < 1 || $rating > 5 ) {

            wp_send_json_error([
                'message' => 'Please select a rating between 1 and 5.'
            ]);

        }


        /*
         * ==========================================
         * IMAGE VALIDATION
         * ==========================================
         */

        if ( empty( $_FILES['Image'] ) ) {

            wp_send_json_error([
                'message' => 'Please upload an image.'
            ]);

        }

        $file = $_FILES['Image'];


        /*
         * Check upload error
         */

        if ( $file['error'] !== UPLOAD_ERR_OK ) {

            wp_send_json_error([
                'message' => 'There was a problem uploading the image.'
            ]);

        }


        /*
         * Make sure this is a real uploaded file
         */

        if ( ! is_uploaded_file( $file['tmp_name'] ) ) {

            wp_send_json_error([
                'message' => 'Invalid uploaded file.'
            ]);

        }


        /*
         * ==========================================
         * CHECK ACTUAL MIME TYPE
         * ==========================================
         */

        $finfo = finfo_open( FILEINFO_MIME_TYPE );

        if ( ! $finfo ) {

            wp_send_json_error([
                'message' => 'Unable to verify image type.'
            ]);

        }

        $real_mime = finfo_file(
            $finfo,
            $file['tmp_name']
        );

        finfo_close( $finfo );


        /*
         * Accept any actual image MIME type
         */

        if ( strpos( $real_mime, 'image/' ) !== 0 ) {

            wp_send_json_error([
                'message' => 'Only image files are allowed.'
            ]);

        }


        /*
         * ==========================================
         * FILE SIZE
         * ==========================================
         *
         * Must be LESS than 1 MB.
         */

        $max_file_size = 1 * 1024 * 1024;

        if ( $file['size'] >= $max_file_size ) {

            wp_send_json_error([
                'message' => 'Image must be smaller than 1 MB.'
            ]);

        }



        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';

        $upload = wp_handle_upload(
            $file,
            [
                'test_form' => false,
            ]
        );

        if ( isset( $upload['error'] ) ) {
            wp_send_json_error([
                'message' => 'Image upload failed.'
            ]);
        }


        /*
        * Create WordPress Media Library attachment
        */

        $attachment = [
            'post_mime_type' => $upload['type'],
            'post_title'     => sanitize_file_name(
                pathinfo( $file['name'], PATHINFO_FILENAME )
            ),
            'post_content'   => '',
            'post_status'    => 'inherit',
        ];

        $attachment_id = wp_insert_attachment(
            $attachment,
            $upload['file']
        );

        if ( is_wp_error( $attachment_id ) ) {
            wp_send_json_error([
                'message' => 'Could not add image to Media Library.'
            ]);
        }


        /*
        * Generate image metadata
        */

        $attachment_metadata = wp_generate_attachment_metadata(
            $attachment_id,
            $upload['file']
        );

        wp_update_attachment_metadata(
            $attachment_id,
            $attachment_metadata
        );


        /*
        * Get attachment URL
        */

        $image_url = wp_get_attachment_url( $attachment_id );

        /**Add Data Into Database */
        global $wpdb;

        $table_name = $wpdb->prefix . 'rvts_reviews';

        $inserted = $wpdb->insert(
            $table_name,
            [
                'name'       => $name,
                'email'      => $email,
                'review'     => $review,
                'rating'     => $rating,
                'image_id'   => $attachment_id,
                'status'     => 'pending',
            ],
            [
                '%s',
                '%s',
                '%s',
                '%d',
                '%d',
                '%s',
            ]
        );

        if ( false === $inserted ) {

            wp_send_json_error([
                'message' => 'Could not save the review.'
            ]);

        }

        /*
        * IMPORTANT:
        * Send a proper AJAX response.
        */
        wp_send_json_success([
            'message' => 'Review submitted successfully.'
        ]);

        


        /*
         * ==========================================
         * TEMPORARY TEST RESPONSE
         * ==========================================
         */

        // wp_send_json_success([
        //     'message' => 'Validation successful.',
        //     'name'    => $name,
        //     'email'   => $email,
        //     'review'  => $review,
        //     'rating'  => $rating,
        // ]);

        

    }

}