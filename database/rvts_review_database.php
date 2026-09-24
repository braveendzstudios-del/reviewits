<?php

class rvts_review_database {

    public static function create_tables() {

        global $wpdb;

        $table_name = $wpdb->prefix . 'rvts_reviews';

        $charset_collate = $wpdb->get_charset_collate();

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $sql = "CREATE TABLE {$table_name} (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        review TEXT NOT NULL,
        rating TINYINT UNSIGNED NOT NULL DEFAULT 0,
        image_id BIGINT UNSIGNED NOT NULL DEFAULT 0,
        status VARCHAR(20) NOT NULL DEFAULT 'pending',
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY status (status),
            KEY rating (rating),
            KEY image_id (image_id)
        ) {$charset_collate};";

        dbDelta( $sql );
    }
}