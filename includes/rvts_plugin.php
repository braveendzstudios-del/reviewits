<?php

use Elementor\Core\Documents_Manager;

class rvts_plugin {

    public function __construct() {

        add_action(
            'elementor/widgets/register',
            array( $this, 'register_widgets' )
        );

        new rvts_review_ajax();

        // rvts_review_database::create_tables();

        /*
         * Reviewits Elementor category.
         */
        add_action(
            'elementor/elements/categories_registered',
            function( $elements_manager ) {

                $elements_manager->add_category(
                    'reviewits',
                    [
                        'title' => esc_html__(
                            'Reviewits',
                            'reviewits'
                        ),
                        'icon'  => 'fa fa-star',
                    ]
                );

            }
        );

        /*
         * Register Review Loop Item document.
         */
        add_action(
            'elementor/documents/register',
            [ $this, 'register_documents' ],
            20,
            1
        );

        /*
         * Validate Reviewits Field IDs
         * before Elementor saves the document.
         */
        add_action(
            'elementor/document/before_save',
            [ $this, 'validate_review_field_ids' ],
            10,
            2
        );
    }


    /**
     * Register Reviewits custom Elementor document.
     *
     * @param Documents_Manager $documents_manager
     */
    public function register_documents(
        Documents_Manager $documents_manager
    ) {

        $documents_manager->register_document_type(
            rvts_review_loop_item_document::get_type(),
            rvts_review_loop_item_document::get_class_full_name()
        );
    }


    /**
     * Validate Reviewits Field IDs before saving.
     *
     * Checks:
     *
     * 1. Duplicate IDs inside the current document.
     * 2. IDs already used by other Elementor documents.
     *
     * @param object $document
     * @param array  $data
     */
    public function validate_review_field_ids(
        $document,
        array $data
    ) {

        $field_ids = [];

        /*
         * --------------------------------------------------
         * 1. Check the document currently being saved.
         * --------------------------------------------------
         */
        $this->check_review_field_ids(
            $data['elements'] ?? [],
            $field_ids
        );


        /*
         * --------------------------------------------------
         * 2. Check other saved Elementor documents.
         * --------------------------------------------------
         */
        $this->check_global_review_field_ids(
            $document,
            $field_ids
        );
    }


    /**
     * Recursively check Review Form widgets.
     *
     * This catches duplicate Field IDs inside:
     *
     * - The same Review Form
     * - Multiple Review Forms
     * - Nested Elementor containers
     *
     * @param array $elements
     * @param array $field_ids
     */
    private function check_review_field_ids(
        $elements,
        &$field_ids
    ) {

        if ( ! is_array( $elements ) ) {
            return;
        }


        foreach ( $elements as $element ) {

            if ( ! is_array( $element ) ) {
                continue;
            }


            /*
             * --------------------------------------------------
             * Check Review Form widget.
             * --------------------------------------------------
             */
            if (
                isset( $element['widgetType'] ) &&
                $element['widgetType'] === 'rvts_review_form'
            ) {

                $settings = $element['settings'] ?? [];

                $fields = $settings['review_fields'] ?? [];


                foreach ( $fields as $field ) {

                    $field_id = isset( $field['field_id'] )
                        ? sanitize_key(
                            $field['field_id']
                        )
                        : '';


                    /*
                     * Ignore empty Field IDs.
                     */
                    if ( ! $field_id ) {
                        continue;
                    }


                    /*
                     * Duplicate Field ID found.
                     */
                    if (
                        isset(
                            $field_ids[ $field_id ]
                        )
                    ) {

                        throw new \Exception(
                            sprintf(
                                'Please choose different Field IDs. The ID "%s" is already being used.',
                                $field_id
                            )
                        );
                    }


                    /*
                     * Remember this Field ID.
                     */
                    $field_ids[ $field_id ] = true;
                }
            }


            /*
             * --------------------------------------------------
             * Check nested Elementor elements.
             * --------------------------------------------------
             */
            if (
                ! empty(
                    $element['elements']
                )
            ) {

                $this->check_review_field_ids(
                    $element['elements'],
                    $field_ids
                );
            }
        }
    }


    /**
     * Check Field IDs used by other Elementor documents.
     *
     * The current document is excluded because its IDs
     * have already been checked above.
     *
     * @param object $document
     * @param array  $field_ids
     */
    private function check_global_review_field_ids(
        $document,
        &$field_ids
    ) {

        global $wpdb;


        /*
         * --------------------------------------------------
         * Get current Elementor document ID.
         * --------------------------------------------------
         */
        $current_document_id = 0;

        if (
            is_object( $document ) &&
            method_exists(
                $document,
                'get_main_id'
            )
        ) {

            $current_document_id = absint(
                $document->get_main_id()
            );
        }


        /*
         * --------------------------------------------------
         * Find all saved Elementor documents that contain
         * Reviewits Review Form widgets.
         * --------------------------------------------------
         */
        $rows = $wpdb->get_results(
            $wpdb->prepare(
                "
                SELECT
                    p.ID,
                    pm.meta_value
                FROM
                    {$wpdb->posts} AS p
                INNER JOIN
                    {$wpdb->postmeta} AS pm
                    ON p.ID = pm.post_id
                WHERE
                    pm.meta_key = '_elementor_data'
                AND
                    pm.meta_value LIKE %s
                AND
                    p.ID != %d
                AND
                    p.post_type != 'revision'
                ",
                '%rvts_review_form%',
                $current_document_id
            ),
            ARRAY_A
        );


        /*
         * --------------------------------------------------
         * Check every saved document.
         * --------------------------------------------------
         */
        foreach ( $rows as $row ) {

            if ( empty( $row['meta_value'] ) ) {
                continue;
            }


            $elements = json_decode(
                $row['meta_value'],
                true
            );


            if ( ! is_array( $elements ) ) {
                continue;
            }


            $this->check_review_field_ids(
                $elements,
                $field_ids
            );
        }
    }


    /**
     * Register Reviewits Elementor widgets.
     *
     * @param object $widgets_manager
     */
    public function register_widgets(
        $widgets_manager
    ) {

        $widgets_manager->register_widget_type(
            new \rvts_review_form()
        );

        $widgets_manager->register_widget_type(
            new \rvts_review_grid()
        );

        $widgets_manager->register_widget_type(
            new \rvts_review_heading()
        );

        $widgets_manager->register_widget_type(
            new \rvts_review_text()
        );

        $widgets_manager->register_widget_type(
            new \rvts_review_image()
        );

        $widgets_manager->register_widget_type(
            new \rvts_review_stars()
        );
    }
}