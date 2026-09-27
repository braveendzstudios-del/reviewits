<?php

class rvts_get_submitted_files {

    public function get() {

        $submitted_files = [];

        foreach ( $_FILES as $field_id => $file ) {

            $submitted_files[
                sanitize_key( $field_id )
            ] = $file;
        }

        return $submitted_files;
    }
}