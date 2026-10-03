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

      //ids 
      add_action(
         'elementor/document/before_save',
         [ $this, 'validate_review_field_ids' ],
         10,
         2
      );

   }

   public function register_documents( Documents_Manager $documents_manager ) {
      $documents_manager->register_document_type(
         rvts_review_loop_item_document::get_type(),
         rvts_review_loop_item_document::get_class_full_name()
      );
   }

   public function validate_review_field_ids( $document, array $data ) {

      $field_ids = [];

      $this->check_review_field_ids(
         $data['elements'] ?? [],
         $field_ids
      );
   }


   /**
    * Recursively check Review Form widgets.
    *
    * @param array $elements
    * @param array $field_ids
    */
   private function check_review_field_ids( $elements, &$field_ids ) {

    if ( ! is_array( $elements ) ) {
        return;
    }

    foreach ( $elements as $element ) {

        if ( ! is_array( $element ) ) {
            continue;
        }

        if (
            isset( $element['widgetType'] ) &&
            $element['widgetType'] === 'rvts_review_form'
        ) {

            $settings = $element['settings'] ?? [];

            $fields = $settings['review_fields'] ?? [];

            foreach ( $fields as $field ) {

                $field_id = isset( $field['field_id'] )
                    ? sanitize_key( $field['field_id'] )
                    : '';

                if ( ! $field_id ) {
                    continue;
                }

                if ( isset( $field_ids[ $field_id ] ) ) {

                    throw new \Exception(
                        sprintf(
                            'Please choose different Field IDs. The ID "%s" is already being used.',
                            $field_id
                        )
                    );
                }

                $field_ids[ $field_id ] = true;
            }
        }

        if ( ! empty( $element['elements'] ) ) {

            $this->check_review_field_ids(
                $element['elements'],
                $field_ids
            );
        }
    }
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