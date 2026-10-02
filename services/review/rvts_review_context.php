<?php

class rvts_review_context {

    private static ?int $review_id = null;


    public static function set( int $review_id ) {

        self::$review_id = $review_id;
    }


    public static function get(): ?int {

        return self::$review_id;
    }


    public static function clear() {

        self::$review_id = null;
    }
}