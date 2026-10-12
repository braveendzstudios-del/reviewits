
<?php
use \Elementor\Widget_Base;


class rvts_review_image_border_radius_control {

    public function register( Widget_Base $widget ) {

        $widget->start_controls_section(
            'review_image_border_radius_section',
            [
                'label' => esc_html__( 'Image Border Radius', 'reviewits' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $widget->add_responsive_control(
            'review_image_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'reviewits' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .rvts-review-image' =>
                        'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $widget->end_controls_section();
    }
}
