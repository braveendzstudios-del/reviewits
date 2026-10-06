<?php

class rvts_review_grid extends \Elementor\Widget_Base {

    public function get_name() {

        return 'rvts_review_grid';

    }


    public function get_title() {

        return esc_html__(
            'Review Grid',
            'reviewits'
        );

    }


    public function get_icon() {

        return 'eicon-posts-grid';

    }


    public function get_categories() {

        return [ 'reviewits' ];

    }


    protected function register_controls() {

        ( new rvts_review_grid_controls() )->register( $this );
        

        ( new rvts_review_grid_style_controls() )->register( $this );

    }


    protected function render() {

        $settings = $this->get_settings_for_display();

        ( new rvts_review_grid_render() )->render( $settings );

    }

}