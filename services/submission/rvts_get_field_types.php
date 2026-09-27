<?php

class rvts_get_field_types {

    public function get() {

        $field_types = [];

        if (
            isset( $_POST['rvts_field_types'] ) &&
            is_array( $_POST['rvts_field_types'] )
        ) {

            $raw_field_types = wp_unslash(
                $_POST['rvts_field_types']
            );

            foreach (
                $raw_field_types as $field_id => $field_type
            ) {

                $field_types[
                    sanitize_key( $field_id )
                ] = sanitize_key(
                    $field_type
                );

            }
        }

        return $field_types;
    }
}