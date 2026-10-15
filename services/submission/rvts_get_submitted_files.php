
<?php

if (! defined('ABSPATH')) {
    exit;
}

class rvts_get_submitted_files
{

    public function get()
    {

        $submitted_files = [];

        // phpcs:ignore WordPress.Security.NonceVerification.Missing -- Nonce verification belongs to the submission handler.
        foreach ($_FILES as $field_id => $file) {

            if (! is_array($file)) {
                continue;
            }

            $clean_field_id = sanitize_key($field_id);

            if ('' === $clean_field_id) {
                continue;
            }

            $submitted_files[$clean_field_id] = $file;
        }

        return $submitted_files;
    }
}
