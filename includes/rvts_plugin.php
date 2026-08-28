<?php

class rvts_plugin {
   public function __construct() {
      add_action('elementor/widgets/register', array($this, 'register_widgets'));

   }

   /**
     * Register Reviewits Elementor widgets.
     *
     * @param object $widgets_manager Elementor widgets manager.
    */

   public function register_widgets( $widgets_manager ) {
      $widgets_manager->register_widget_type( new \rvts_review_form() );
   }
}