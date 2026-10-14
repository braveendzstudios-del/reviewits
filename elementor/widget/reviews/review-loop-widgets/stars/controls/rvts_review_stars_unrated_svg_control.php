<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class rvts_review_stars_unrated_svg_control {

    public function register( \Elementor\Widget_Base $widget ) {

        $widget->add_control(
            'unrated_star_svg',
            [
                'label' => esc_html__(
                    'Unrated Star SVG',
                    'reviewits'
                ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'media_types' => ['image/svg+xml'],
                'default' => [
                    'url' => 'reviewits/elementor/assets/svg/star-inactive.svg',
                    __FILE__
                ],
                'description' => esc_html__(
                    'Choose or upload the SVG used for unrated stars.',
                    'reviewits'
                ),
            ]
        );
    }
}