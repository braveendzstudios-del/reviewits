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
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $fileds = $settings['review_fields']??[];

        ?>

        <div class="rvts-review-form">
            <form id="rvts-review-form" method="post">
                <?php
                foreach ($fileds as $field) {
                    $type = $field['field_type'] ?? 'Text';
                    $label = $field['label_type'] ?? '';
                    $placeholder = $field['placeholder'] ?? '';
                    $required = !empty($field['field_required']) ? 'required' : '';

                    echo '<div class="rvts-form-group">';
                    echo '<label>' . esc_html($label) . '</label>';

                    if ($type === 'textarea') {
                        echo '<textarea name="' . esc_attr($label) . '" placeholder="' . esc_attr($placeholder) . '" ' . esc_attr($required) . '></textarea>';
                    } else {
                        echo '<input type="' . esc_attr($type) . '" name="' . esc_attr($label) . '" placeholder="' . esc_attr($placeholder) . '" ' . esc_attr($required) . ' />';
                    }
                    echo '</div>';
                }
                ?>

                <button type="submit"><?php esc_html_e('Submit Review', 'reviewits'); ?></button>
            </form>
            
        </div>

        <?php
    }
}