
<?php

if (! defined('ABSPATH')) {
    exit;
}

class rvts_get_latest_review_image
{


    public function get(string $field_id)
    {

        global $wpdb;

        $reviews_table = $wpdb->prefix . 'rvts_reviews';
        $fields_table  = $wpdb->prefix . 'rvts_review_fields';
        $field_id      = sanitize_key($field_id);

        if (! $field_id) {
            return null;
        }

        $image = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT
                r.id AS review_id,
                f.field_value
            FROM %i AS r
            INNER JOIN %i AS f
                ON f.review_id = r.id
            WHERE f.field_id = %s
                AND f.field_type = 'image'
            ORDER BY r.created_at DESC, r.id DESC
            LIMIT 1",
                $reviews_table,
                $fields_table,
                $field_id
            ),
            ARRAY_A
        );

        if (empty($image['field_value'])) {
            return null;
        }

        $value = trim((string) $image['field_value']);

        if (is_numeric($value)) {
            $image_url = wp_get_attachment_image_url(
                absint($value),
                'full'
            );
        } else {
            $image_url = esc_url_raw($value);
        }

        if (! $image_url) {
            return null;
        }

        return [
            'review_id' => absint($image['review_id']),
            'image_url' => $image_url,
        ];
    }
}
