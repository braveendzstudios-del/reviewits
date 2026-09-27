<?php

class rvts_review_database {

    public static function create_tables() {

        global $wpdb;

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $charset_collate = $wpdb->get_charset_collate();


        /*
         * ==========================================
         * REVIEWS TABLE
         * ==========================================
         */

        $reviews_table = $wpdb->prefix . 'rvts_reviews';

        $reviews_sql = "CREATE TABLE {$reviews_table} (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            review TEXT NOT NULL,
            rating TINYINT UNSIGNED NOT NULL DEFAULT 0,
            image_id BIGINT UNSIGNED NOT NULL DEFAULT 0,
            status VARCHAR(20) NOT NULL DEFAULT 'pending',
            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            INDEX status_index (status),
            INDEX rating_index (rating),
            INDEX image_id_index (image_id)
        ) {$charset_collate};";


        /*
         * ==========================================
         * DYNAMIC REVIEW FIELDS TABLE
         * ==========================================
         */

        $fields_table = $wpdb->prefix . 'rvts_review_fields';

        $fields_sql = "CREATE TABLE {$fields_table} (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            review_id BIGINT UNSIGNED NOT NULL,
            field_id VARCHAR(255) NOT NULL,
            field_type VARCHAR(50) NOT NULL,
            field_value LONGTEXT NULL,
            PRIMARY KEY (id),
            INDEX review_id_index (review_id),
            INDEX field_id_index (field_id),
            INDEX field_type_index (field_type)
        ) {$charset_collate};";


        /*
         * ==========================================
         * CREATE / UPDATE TABLES
         * ==========================================
         */

        dbDelta( $reviews_sql );

        dbDelta( $fields_sql );

    }
}