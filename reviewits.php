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

