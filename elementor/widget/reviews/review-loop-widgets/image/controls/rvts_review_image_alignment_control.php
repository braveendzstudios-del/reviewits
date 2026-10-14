
<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}



use \Elementor\Widget_Base;

class rvts_review_image_alignment_control {

    public function register( Widget_Base $widget ) {

        $widget->add_responsive_control(
            'review_image_alignment',
            [
                'label'   => esc_html__( 'Alignment', 'reviewits' ),
                'type'    => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'reviewits' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'reviewits' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'reviewits' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container' =>
                        'display: flex; justify-content: {{VALUE}};',
                ],
            ]
        );

        $widget->end_controls_section();
    }
}
