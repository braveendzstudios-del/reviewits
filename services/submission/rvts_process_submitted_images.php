<?php

class rvts_process_submitted_images {

    public function process( array $submitted_files ) {

        if ( empty( $submitted_files ) ) {
            return [];
        }

        $image_service =
            new rvts_review_image_service();

        return $image_service->process(
            $submitted_files
        );
    }
}