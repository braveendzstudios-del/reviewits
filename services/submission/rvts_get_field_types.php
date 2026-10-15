
<?php

if (! defined('ABSPATH')) {
    exit;
}

class rvts_get_field_types
{

    public function get()
    {

        $field_types = [];

        // Nonce verification is performed by rvts_review_ajax::submit_review().
        if (! isset($_POST['rvts_field_types'])) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
            return $field_types;
        }

        // The AJAX handler verifies the nonce before calling this service.
        $raw_field_types = wp_unslash(
            $_POST['rvts_field_types'] // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
        );

        if (! is_array($raw_field_types)) {
            return $field_types;
        }

        foreach ($raw_field_types as $field_id => $field_type) {

            if (! is_string($field_type)) {
                continue;
            }

            $sanitized_field_id   = sanitize_key((string) $field_id);
            $sanitized_field_type = sanitize_key($field_type);

            if (
                '' === $sanitized_field_id ||
                '' === $sanitized_field_type
            ) {
                continue;
            }

            $field_types[$sanitized_field_id] = $sanitized_field_type;
        }

        return $field_types;
    }
}
