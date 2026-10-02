<?php

class rvts_review_grid_controls {

    public function register( \Elementor\Widget_Base $widget ) {

        $widget->start_controls_section(
            'template_section',
            [
                'label' => esc_html__(
                    'Review Template',
                    'reviewits'
                ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $template_options = (
            new rvts_review_grid_template_options()
        )->get();

        $widget->add_control(
            'template_id',
            [
                'label'       => esc_html__(
                    'Choose Template',
                    'reviewits'
                ),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options'     => $template_options,
                'default'     => '',
            ]
        );

        $create_url =
            rvts_review_loop_item_document::get_create_url();

        $widget->add_control(
            'create_template',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw'  => sprintf(
                    '<a
                        href="%s"
                        target="_blank"
                        class="elementor-button elementor-button-success"
                        style="
                            display:block;
                            text-align:center;
                            margin-top:5px;
                        "
                    >
                        + %s
                    </a>',
                    esc_url( $create_url ),
                    esc_html__(
                        'Create a template',
                        'reviewits'
                    )
                ),
            ]
        );

        $widget->end_controls_section();
    }
}