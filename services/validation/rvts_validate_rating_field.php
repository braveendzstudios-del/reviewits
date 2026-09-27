<?php

class rvts_validate_rating_field {

    public function validate(
        int $value,
        int $maximum
    ) {

        if (
            $value < 1 ||
            $value > $maximum
        ) {
            return new WP_Error(
                'invalid_rating',
                'Please select a valid rating.'
            );
        }

        return true;
    }
}