<?php

class rvts_review_grid_template_options {

    public function get() {

        $templates = get_posts(
            [
                'post_type'      => 'elementor_library',
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
                'meta_key'       => \Elementor\Core\Base\Document::TYPE_META_KEY,
                'meta_value'     => rvts_review_loop_item_document::get_type(),
            ]
        );

        $options = [];

        foreach ( $templates as $template ) {

            $options[ (string) $template->ID ] =
            $template->post_title;
        }

        return $options;
    }
}