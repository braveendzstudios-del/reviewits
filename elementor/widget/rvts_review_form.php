<?php
use Elementor\Controls_Manager;
use Elementor\Repeater;

class rvts_review_form extends \Elementor\Widget_Base {

    public function get_name() {
        return 'rvts_review_form';
    }

    public function get_title() {
        return esc_html__( 'Review Form', 'reviewits' );
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    public function get_categories() {
        return ['Reviewits'];
    }

  

    //controls for the widget
    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'reviewits' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();
        (new rvts_control_handler())->register_controls($repeater);
        
        //default repeater fields for the review form
        $this->add_control(
            'review_fields',
            [
                'label' => esc_html__( 'Review Form Fields', 'reviewits' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ label_type }}}',

                'default' => [
                    [
                        'field_type' => 'text',
                        'label_type' => esc_html__( 'Name', 'reviewits' ),
                        'placeholder' => esc_html__( 'Enter your name', 'reviewits' ),
                        'field_required' => true,
                    ],
                    [
                        'field_type' => 'email',
                        'label_type' => esc_html__( 'Email', 'reviewits' ),
                        'placeholder' => esc_html__( 'Enter your email', 'reviewits' ),
                        'field_required' => true,
                    ],
                    [
                        'field_type' => 'textarea',
                        'label_type' => esc_html__( 'Review', 'reviewits' ),
                        'placeholder' => esc_html__( 'Write your review here', 'reviewits' ),
                        'field_required' => true,
                    ],
                ],
            ],
            
        );
        

        
        // Add a control for the submit button text
        $this->add_control(
            'submit_button_text',
            [
                'label' => esc_html__( 'Submit Button Text', 'reviewits' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Submit Review', 'reviewits' ),
                'label_block' => true,
            ]
        );

        

        $this->end_controls_section();
    }

    //register style controls for the widget
    protected function register_style_controls() {
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Style', 'reviewits' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Add style controls here (e.g., colors, typography, spacing)

        $this->end_controls_section();
    }



    //render the widget output on the frontend
    protected function render() {
        $settings = $this->get_settings_for_display();

        $fileds = $settings['review_fields'] ?? [];

        $submit_button_text = $settings['submit_button_text'] ?? esc_html__('Submit Review', 'reviewits');

        ?>

        <div class="rvts-review-form">
            <form id="rvts-review-form" method="post" enctype="multipart/form-data">
                <?php

                    foreach ($fileds as $field) {
                        $type = $field['field_type'] ?? 'text';
                        $renderer_class = 'rvts_' . $type . '_field';

                        if (class_exists($renderer_class)) {
                            $renderer = new $renderer_class();
                            $renderer->render($field);
                        } else {
                            echo '<p>' . esc_html__('Renderer not found for field type: ', 'reviewits') . esc_html($type) . '</p>';
                        }
                    }
                ?>

                <button type="submit"><?php echo esc_html($submit_button_text); ?></button>
            </form>

            </form>
            
        </div>

        <?php
    }


}