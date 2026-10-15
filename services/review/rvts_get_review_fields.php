
<?php

if (! defined('ABSPATH')) {
    exit;
}

class rvts_get_review_fields
{

    public function get(int $review_id)
    {

        global $wpdb;

        $table = $wpdb->prefix . 'rvts_review_fields';

        $fields = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT *
                FROM %i
                WHERE review_id = %d
                ORDER BY id ASC",
                $table,
                absint($review_id)
            ),
            ARRAY_A
        );

        if (empty($fields)) {
            return [];
        }

        return $fields;
    }
}
