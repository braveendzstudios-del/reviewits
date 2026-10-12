<?php

class rvts_review_stars_rated_svg_control {

    public function register( \Elementor\Widget_Base $widget ) {

        $widget->add_control(
            'rated_star_svg',
            [
                'label' => esc_html__(
                    'Rated Star SVG',
                    'reviewits'
                ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'media_types' => ['image/svg+xml'],
                'default' => [
                    'url' => 'reviewits/elementor/assets/svg/star-active.svg',
                    __FILE__
                ],
                
                'description' => esc_html__(
                    'Choose or upload the SVG used for rated stars.',
                    'reviewits'
                ),
            ]
        );
    }
}