<?php 
/**
 * Plugin Name:  Reviewits
 * Description: This Plugin helps you to create fully Customizable testimonials and 
 * reviews for your website. Using Elementor Page Builder, you can easily create a 
 * testimonial and review section for your website. 
 * slug: reviewits
 * Author: kulwindersingh5555
 * License: GPL2 or later
 * Text Domain: reviewits
 *  Requires Plugins: elementor
 */

if( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once plugin_dir_path(__FILE__) . 'includes/rvts_autoloader.php';
new rvts_autoloader();

register_activation_hook(
    __FILE__,
    [ 'rvts_review_database', 'create_tables' ]
);



function reviewits_init() {

    // Check if Elementor is loaded
    if ( ! did_action( 'elementor/loaded' ) ) {
        add_action( 'admin_notices', 'reviewits_elementor_missing_notice' );
        return;
    }

    // Elementor is available.
    // Initialize Reviewits here.

    new rvts_plugin();
}

add_action( 'plugins_loaded', 'reviewits_init' );


/**
 * Admin notice when Elementor is missing
 */
function reviewits_elementor_missing_notice() {
    ?>
    <div class="notice notice-error">
        <p>
            <strong>Reviewits</strong> requires <strong>Elementor</strong> to be installed and activated.
        </p>
    </div>
    <?php
}

/*
Enque the necessary scripts and styles for the plugin
 */

//enqueue the necessary javascript for the review form
function enqueue_scripts() {
    wp_enqueue_script('reviewits-form-review', 
    plugins_url('elementor/assets/js/rvts_form_review.js', __FILE__), 
    array('jquery'), null, true);

    wp_enqueue_script(
    'reviewits-rvts-form-ajax-handler',
    plugins_url( 'elementor/assets/js/rvts_form_ajax_handler.js', __FILE__ ),
    array( 'jquery' ), null, true);

    wp_localize_script(
    'reviewits-rvts-form-ajax-handler',
    'rvts_ajax',
    array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'rvts_submit_review' ),
    )
);
}

add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );

//enqueue the necessary styles for the review form
function enqueue_styles() {
    wp_enqueue_style('reviewits-form-review', 
    plugins_url('elementor/assets/css/rvts_form_review.css', __FILE__));
}

add_action( 'wp_enqueue_scripts', 'enqueue_styles' );