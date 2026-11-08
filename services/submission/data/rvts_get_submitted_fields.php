
<?php

if (! defined('ABSPATH')) {
    exit;
}

class rvts_get_submitted_fields
{

    public function get()
    {

        $submitted_fields = [];

        // phpcs:ignore WordPress.Security.NonceVerification.Missing -- Nonce verification belongs to the submission handler.
        $post_data = wp_unslash($_POST);

        foreach ($post_data as $field_id => $value) {

            if (
                in_array(
                    $field_id,
                    [
                        'action',
                        'nonce',
                        'rvts_field_types',
                        'rvts_field_configuration',
                    ],
                    true
                )
            ) {
                continue;
            }

            $clean_field_id = sanitize_key($field_id);

            if ('' === $clean_field_id) {
                continue;
            }

            if (is_array($value)) {

                $submitted_fields[$clean_field_id] = map_deep(
                    $value,
                    static function ($item) {
                        return is_string($item)
                            ? sanitize_text_field($item)
                            : $item;
                    }
                );
            } elseif (is_string($value)) {

                $submitted_fields[$clean_field_id] =
                    sanitize_textarea_field($value);
            }
        }

        return $submitted_fields;
    }
}
