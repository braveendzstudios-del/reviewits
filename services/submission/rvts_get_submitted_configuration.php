<?php

class rvts_get_submitted_configuration {

    public function get() {

        $configuration = [];

        if (
            empty( $_POST['rvts_field_configuration'] )
        ) {
            return $configuration;
        }

        $raw_configuration = wp_unslash(
            $_POST['rvts_field_configuration']
        );

        $configuration = json_decode(
            $raw_configuration,
            true
        );

        if ( ! is_array( $configuration ) ) {
            return [];
        }

        return $configuration;
    }
}