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

            $base . 'services/submission/' .
                $class_name . '.php',

            $base . 'services/configuration/' .
                $class_name . '.php',

            $base . 'services/review/' .
                $class_name . '.php',

            $base . 'services/validation/' .
                $class_name . '.php',

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