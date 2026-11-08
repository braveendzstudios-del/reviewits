
<?php

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Cache utilities for Reviewits review data.
 */
class rvts_review_cache
{

    const CACHE_GROUP = 'reviewits';
    const VERSION_OPTION = 'rvts_review_cache_version';

    /**
     * Get the current cache generation.
     *
     * @return string
     */
    public static function get_version()
    {
        $version = get_option(self::VERSION_OPTION, '1');

        return is_scalar($version) ? (string) $version : '1';
    }

    /**
     * Build a cache key.
     *
     * @param string $prefix Cache key prefix.
     * @param array  $args   Values distinguishing cache entries.
     * @return string
     */
    public static function make_key($prefix, array $args = [])
    {
        return sanitize_key($prefix) . '_' .
            self::get_version() . '_' .
            md5(serialize($args));
    }

    /**
     * Invalidate cached review data after a successful write.
     *
     * @return void
     */
    public static function invalidate()
    {
        update_option(
            self::VERSION_OPTION,
            wp_generate_uuid4(),
            false
        );
    }
}
