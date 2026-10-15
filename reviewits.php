<?php

/**
 * Plugin Name: Reviewits
 * Description: This Plugin helps you to create fully customizable testimonials and reviews for your website using Elementor Page Builder.
 * Author: kulwindersingh5555
 * License: GPL2 or later
 * Text Domain: reviewits
 * Requires Plugins: elementor
 * Version: 1.0.0
 */

if (! defined('ABSPATH')) {
    exit;
}

require_once plugin_dir_path(__FILE__) . 'includes/rvts_autoloader.php';
new rvts_autoloader();

register_activation_hook(
    __FILE__,
    ['rvts_review_database', 'create_tables']
);

/**
 * Initialize Reviewits.
 */
function rvts_reviewits_init()
{
    if (! did_action('elementor/loaded')) {
        add_action(
            'admin_notices',
            'rvts_reviewits_elementor_missing_notice'
        );
        return;
    }

    new rvts_plugin();
}

add_action('plugins_loaded', 'rvts_reviewits_init');

/**
 * Display a notice when Elementor is unavailable.
 */
function rvts_reviewits_elementor_missing_notice()
{
?>
    <div class="notice notice-error">
        <p>
            <strong>Reviewits</strong> requires
            <strong>Elementor</strong> to be installed and activated.
        </p>
    </div>
<?php
}

/**
 * Enqueue JavaScript assets.
 */
function rvts_enqueue_scripts()
{
    $form_script_path = plugin_dir_path(__FILE__)
        . 'elementor/assets/js/rvts_form_review.js';

    wp_enqueue_script(
        'reviewits-form-review',
        plugins_url(
            'elementor/assets/js/rvts_form_review.js',
            __FILE__
        ),
        ['jquery'],
        file_exists($form_script_path)
            ? (string) filemtime($form_script_path)
            : '1.0.0',
        true
    );

    $ajax_script_path = plugin_dir_path(__FILE__)
        . 'elementor/assets/js/rvts_form_ajax_handler.js';

    wp_enqueue_script(
        'reviewits-rvts-form-ajax-handler',
        plugins_url(
            'elementor/assets/js/rvts_form_ajax_handler.js',
            __FILE__
        ),
        ['jquery'],
        file_exists($ajax_script_path)
            ? (string) filemtime($ajax_script_path)
            : '1.0.0',
        true
    );

    $read_more_script_path = plugin_dir_path(__FILE__)
        . 'elementor/assets/js/rvts_review_text_read_more.js';

    wp_enqueue_script(
        'reviewits-rvts-review-text-read-more',
        plugins_url(
            'elementor/assets/js/rvts_review_text_read_more.js',
            __FILE__
        ),
        ['jquery'],
        file_exists($read_more_script_path)
            ? (string) filemtime($read_more_script_path)
            : '1.0.0',
        true
    );

    wp_localize_script(
        'reviewits-rvts-form-ajax-handler',
        'rvts_ajax',
        [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('rvts_submit_review'),
        ]
    );
}

add_action('wp_enqueue_scripts', 'rvts_enqueue_scripts');

/**
 * Enqueue CSS assets.
 */
function rvts_enqueue_styles()
{
    $form_style_path = plugin_dir_path(__FILE__)
        . 'elementor/assets/css/rvts_form_review.css';

    wp_enqueue_style(
        'reviewits-form-review',
        plugins_url(
            'elementor/assets/css/rvts_form_review.css',
            __FILE__
        ),
        [],
        file_exists($form_style_path)
            ? (string) filemtime($form_style_path)
            : '1.0.0'
    );

    $read_more_style_path = plugin_dir_path(__FILE__)
        . 'elementor/assets/css/rvts_review_text_widget.css';

    wp_enqueue_style(
        'reviewits-rvts-review-text-read-more',
        plugins_url(
            'elementor/assets/css/rvts_review_text_widget.css',
            __FILE__
        ),
        [],
        file_exists($read_more_style_path)
            ? (string) filemtime($read_more_style_path)
            : '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'rvts_enqueue_styles');
