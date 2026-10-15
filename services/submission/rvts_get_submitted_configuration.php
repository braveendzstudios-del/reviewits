
<?php

if (! defined('ABSPATH')) {
    exit;
}

class rvts_get_submitted_configuration
{

    public function get()
    {

        // phpcs:ignore WordPress.Security.NonceVerification.Missing -- Nonce verification belongs to the submission handler.
        if (! isset($_POST['rvts_field_configuration'])) {
            return [];
        }

        // phpcs:ignore WordPress.Security.NonceVerification.Missing -- Nonce verification belongs to the submission handler.
        $raw_configuration = wp_unslash(
            $_POST['rvts_field_configuration']
        );

        if (! is_string($raw_configuration) || '' === $raw_configuration) {
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
