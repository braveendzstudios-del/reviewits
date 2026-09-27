<?php

class rvts_save_submittable_fields {

    public function save(
        int $review_id,
        array $submittable_fields,
        array $uploaded_image_ids
    ) {

        $field_saver = new rvts_save_review_field();

        $image_field_saver = new rvts_save_review_image_field();

        foreach ( $submittable_fields as $field_id => $field ) {

            /*
             * Make sure configuration exists.
             */
            if (
                ! isset( $field['configuration'] ) ||
                ! is_array( $field['configuration'] )
            ) {
                continue;
            }

            $configuration = $field['configuration'];

            $field_type = isset( $configuration['field_type'] )
                ? (string) $configuration['field_type']
                : '';

            /*
             * Image field.
             */
            if ( 'image' === $field_type ) {

                if (
                    ! isset( $uploaded_image_ids[ $field_id ] )
                ) {
                    continue;
                }

                $result = $image_field_saver->save(
                    $review_id,
                    (string) $field_id,
                    (int) $uploaded_image_ids[ $field_id ]
                );

            }

            /*
             * All other field types.
             */
            else {

                if ( ! array_key_exists( 'value', $field ) ) {
                    continue;
                }

                $result = $field_saver->save(
                    $review_id,
                    (string) $field_id,
                    $field_type,
                    $field['value']
                );
            }

            /*
             * Stop if saving fails.
             */
            if ( is_wp_error( $result ) ) {
                return $result;
            }
        }

        return true;
    }
}