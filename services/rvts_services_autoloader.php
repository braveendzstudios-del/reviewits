<?php

class rvts_services_autoloader {

    public function __construct() {

        spl_autoload_register(
            [ $this, 'autoload' ]
        );
    }

    public function autoload( string $class_name ) {

        $base = plugin_dir_path( __DIR__ );

        $paths = [

            // Submission services.
            $base . 'services/submission/data/' . $class_name . '.php',

            $base . 'services/submission/validation/' . $class_name . '.php',

            $base . 'services/submission/processing/' . $class_name . '.php',

            $base . 'services/configuration/' .
                $class_name . '.php',

            // Review services.
            $base . 'services/review/data/' . $class_name . '.php',

            $base . 'services/review/fields/' . $class_name . '.php',

            $base . 'services/review/extractors/' . $class_name . '.php',

            $base . 'services/review/media/' . $class_name . '.php',

            $base . 'services/review/cache/' . $class_name . '.php',

            $base . 'services/review/context/' . $class_name . '.php',

            $base . 'services/review/rendering/' . $class_name . '.php',
            
            $base . 'services/validation/' .$class_name . '.php',
            
            
            $base . 'services/image/' .
                $class_name . '.php',

            $base . 'services/database/' .
                $class_name . '.php',
        ];

        foreach ( $paths as $file ) {

            if ( file_exists( $file ) ) {

                require_once $file;

                return;
            }
        }
    }
}