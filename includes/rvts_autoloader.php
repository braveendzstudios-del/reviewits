<?php 

class rvts_autoloader{
    public function __construct() {
        spl_autoload_register( array( $this, 'autoload' ) );
        new rvts_services_autoloader();
    }


    public function autoload( string $class_name ) {
        

        $base = plugin_dir_path(__DIR__); // go one level up (plugin root)

        $paths = [
            $base. $class_name . '.php',
            $base . 'includes/' . $class_name . '.php',

            /**Widgets */
            $base . 'elementor/widget/' . $class_name . '.php',
            $base . 'elementor/widget/reviews/grid/' . $class_name . '.php',

            /**Widget For Reviews */
            $base . 'elementor/widget/reviews/review loop widgets/heading/' . $class_name . '.php',
            $base . 'elementor/widget/reviews/review loop widgets/text/' . $class_name . '.php',
            $base . 'elementor/widget/reviews/review loop widgets/image/' . $class_name . '.php',
            $base . 'elementor/widget/reviews/review loop widgets/stars/' . $class_name . '.php',
            
            /**template*/
            $base . 'elementor/template/' . $class_name . '.php',
            
            /**form*/
            $base . 'elementor/controls/form/' . $class_name . '.php',
            $base . 'elementor/renderers/form/' . $class_name . '.php',
            $base . 'elementor/style-controls/form/' . $class_name . '.php',
            
            /**Data Base*/
            $base . 'database/' . $class_name . '.php',
            $base . 'ajax/' .$class_name . '.php',
            $base . 'services/' . $class_name . '.php',
        ];
        


        foreach ( $paths as $file ) {
            if ( file_exists( $file ) ) {
                require_once $file;
                return;
            }
        } 
    }
}

