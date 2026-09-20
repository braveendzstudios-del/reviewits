<?php
class rvts_form_style_autoloader {

    public function __construct() {
        spl_autoload_register( array( $this, 'rvts_style_autoload' ) );
    }

    public function rvts_style_autoload( string $class_name ) {
        if ( false === strpos( $class_name, 'rvts_form_' ) ) {
            return;

        }

        $base = plugin_dir_path( __FILE__ ) ;

        $paths = [
            $base,
            $base . 'form_input_controls/',
            $base . 'form_input_controls/form_input_border_control/',
            $base . 'form_input_controls/form_input_placeholder_control/',
            $base . 'form_label_controls/',
            $base . 'form_input_rating_controls/',
            $base . 'form_input_button_controls/',
            $base . 'form_input_button_controls/rvts_form_button_top_control/',
            $base . 'form_input_button_controls/rvts_form_button_normal_control/',
            $base . 'form_input_button_controls/rvts_form_button_hover_control/',
        ];

        foreach ( $paths as $path ) {
            $file = $path . $class_name . '.php';
            if ( file_exists( $file ) ) {
                require_once $file;
            }
        }
    }
}