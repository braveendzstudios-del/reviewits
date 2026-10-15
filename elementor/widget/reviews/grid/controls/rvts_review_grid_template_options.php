
<?php

if (! defined('ABSPATH')) {
    exit;
}

class rvts_review_grid_template_options
{

    public function get()
    {


        $templates = get_posts(

            [
                'post_type'              => 'elementor_library',
                'post_status'            => 'publish',
                'posts_per_page'         => -1,
                'orderby'                => 'title',
                'order'                  => 'ASC',
                // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query -- Required to filter Elementor templates by Reviewits document type.
                'meta_query' => [
                    [
                        // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key -- Required to filter Elementor document types.
                        'key'   => \Elementor\Core\Base\Document::TYPE_META_KEY,

                        // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value -- Required to show only Reviewits loop item templates.
                        'value' => rvts_review_loop_item_document::get_type(),
                    ],
                ],
                'no_found_rows'          => true,
                'update_post_meta_cache' => false,
                'update_post_term_cache' => false,
            ]
        );

        $options = [];

        foreach ($templates as $template) {

            $options[(string) $template->ID] =
                $template->post_title;
        }

        return $options;
    }
}
