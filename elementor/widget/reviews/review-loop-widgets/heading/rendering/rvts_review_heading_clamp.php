<?php

class rvts_review_heading_clamp {

    public function clamp(
        string $text,
        int $limit = 30
    ): string {

        $text = trim( $text );

        if ( $limit <= 0 ) {
            return $text;
        }

        if ( mb_strlen( $text ) <= $limit ) {
            return $text;
        }

        return mb_substr(
            $text,
            0,
            $limit
        ) . '...';
    }
}