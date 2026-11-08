
<?php

if (! defined('ABSPATH')) {
    exit;
}

class rvts_get_submitted_configuration
{

    public function get()
    {

        if (! isset($_POST['rvts_field_configuration'])) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
            return [];
        }

        // Nonce verification is performed by rvts_review_ajax::submit_review().
        $raw_configuration = wp_unslash(
            $_POST['rvts_field_configuration'] // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
        );

        if (
            ! is_string($raw_configuration) ||
            '' === $raw_configuration
        ) {
            return [];
        }

        $configuration = json_decode(
            $raw_configuration,
            true
        );

        if (! is_array($configuration)) {
            return [];
        }

        return map_deep(
            $configuration,
            static function ($value) {
                return is_string($value)
                    ? sanitize_text_field($value)
                    : $value;
            }
        );
    }
}
