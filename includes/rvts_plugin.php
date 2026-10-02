<?php
use Elementor\Core\Documents_Manager;
class rvts_plugin {
   public function __construct() {
      add_action('elementor/widgets/register', array($this, 'register_widgets'));
      new rvts_review_ajax();

      //rvts_review_database::create_tables();
      add_action(
      'elementor/elements/categories_registered',
         function( $elements_manager ) {

            $elements_manager->add_category(
                  'reviewits',
                  [
                     'title' => esc_html__( 'Reviewits', 'reviewits' ),
                     'icon'  => 'fa fa-star',
                  ]
            );

         }
      );

      //template hook

      add_action(
         'elementor/documents/register',
         [ $this, 'register_documents' ],
         20,
         1
      );

   }

   public function register_documents( Documents_Manager $documents_manager ) {
      $documents_manager->register_document_type(
         rvts_review_loop_item_document::get_type(),
         rvts_review_loop_item_document::get_class_full_name()
      );
   }

   

   /**
     * Register Reviewits Elementor widgets.
     *
     * @param object $widgets_manager Elementor widgets manager.
    */

   public function register_widgets( $widgets_manager ) {
      $widgets_manager->register_widget_type( new \rvts_review_form() );
      $widgets_manager->register_widget_type( new \rvts_review_grid() );
      $widgets_manager->register_widget_type(new \rvts_review_heading());
      $widgets_manager->register_widget_type(new \rvts_review_text());
      $widgets_manager->register_widget_type(new \rvts_review_image());
      $widgets_manager->register_widget_type(new \rvts_review_stars()
);
   }

   
   
}