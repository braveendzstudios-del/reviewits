
<?php
use \Elementor\Widget_Base;

class rvts_review_image_border_control {

    public function register( Widget_Base $widget ) {

        $widget->start_controls_section(
            'review_image_border_section',
            [
                'label' => esc_html__( 'Image Border', 'reviewits' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $widget->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'review_image_border',
                'label'    => esc_html__( 'Border', 'reviewits' ),
                'selector' => '{{WRAPPER}} .rvts-review-image',
            ]
        );

        $widget->end_controls_section();
    }
}
