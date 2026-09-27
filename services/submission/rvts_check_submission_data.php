<?php

class rvts_check_submission_data {

    public function check(
        array $submitted_fields,
        array $submitted_files
    ) {

        return ! empty( $submitted_fields ) ||
            ! empty( $submitted_files );
    }
}