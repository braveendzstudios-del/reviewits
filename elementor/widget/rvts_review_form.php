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
                    $label = $field['label_type'] ?? '';
                    $placeholder = $field['placeholder'] ?? '';
                    $required = !empty($field['field_required']) ? 'required' : '';

                    echo '<div class="rvts-form-group">';
                    
                    //checkbox field type
                    if( $type === 'checkbox') {
                        echo'<label class="rvts-checkbox-label">';
                        echo '<input type="checkbox" name="' . esc_attr($label) . '" ' . esc_attr($required) . ' value="1" />';
                        echo '<span>' . esc_html($label) . '</span>';
                        echo '</label>';
                    }else if($type =='image'){
                        // image field type
                        echo '<label>' . esc_html($label) . '</label>';
                        echo '<input type="file" name="' . esc_attr($label) . '" ' . esc_attr($required) . ' accept="image/*" />';
                    }else if($type === 'rating'){
                        //rating field type
                        echo '<label>' . esc_html($label) . '</label>';
                        $star = !empty($field['rating']) ?(int) $field ['rating']:5;
                        
                        $active_star = !empty($field['active_star']['url']) ? 
                        $field['active_star']['url'] : plugins_url( '../assets/star-active.svg', __FILE__);

                        $inactive_star = !empty($field['inactive_star']['url']) ? 
                        $field['inactive_star']['url'] : plugins_url( '../assets/star-inactive.svg', __FILE__);

                        echo '<div class="rvts-rating" data-active-star="'.esc_url($active_star).'"
                        data-inactive-star="'.esc_url($inactive_star).'">';
                            
                            for($i = 1; $i <= $star; $i++) {
                                echo'<img src=" '.esc_url($inactive_star).' "
                                data-active-src="'.esc_url($active_star).'"
                                data-inactive-src="'.esc_url($inactive_star).'"
                                alt="star" class="rvts-star"
                                data-rating= "'. esc_attr($i) . '"
                                />';
                            
                            }

                        echo'</div>';

                        echo '<input type="hidden" name="' . esc_attr($label) . '" value="0" />';
                    }
                    else if ($type === 'textarea') {
                        //textarea field type
                        echo '<label>' . esc_html($label) . '</label>';
                        echo '<textarea 
                        name="' . esc_attr($label) . '" 
                        placeholder="' . esc_attr($placeholder) . '" ' 
                        . esc_attr($required) . '></textarea>';
                    } else {
                        echo '<label>' . esc_html($label) . '</label>';
                        echo '<input 
                        type="' . esc_attr($type) . '" 
                        name="' . esc_attr($label) . '" 
                        placeholder="' . 
                        esc_attr($placeholder) . '" ' . 
                        esc_attr($required) . ' />';
                    }
                    echo '</div>';
                }
                ?>

                <button type="submit"><?php echo esc_html($submit_button_text); ?></button>
            </form>

            </form>

<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.rvts-rating').forEach(function (ratingBox) {

        const stars = ratingBox.querySelectorAll('.rvts-star');

        const ratingInput = ratingBox.parentElement.querySelector(
            '.rvts-rating-value'
        );

        let selectedRating = 0;


        // Change star images
        function updateStars(rating) {

            stars.forEach(function (star) {

                const starRating = parseInt(
                    star.getAttribute('data-rating'),
                    10
                );

                if (starRating <= rating) {

                    star.src = star.getAttribute('data-active-src');

                } else {

                    star.src = star.getAttribute('data-inactive-src');

                }

            });

        }


        // Hover over a star
        stars.forEach(function (star) {

            star.addEventListener('mouseenter', function () {

                const hoverRating = parseInt(
                    this.getAttribute('data-rating'),
                    10
                );

                updateStars(hoverRating);

            });


            // Click a star
            star.addEventListener('click', function () {

                selectedRating = parseInt(
                    this.getAttribute('data-rating'),
                    10
                );

                ratingInput.value = selectedRating;

                updateStars(selectedRating);

            });

        });


        // Mouse leaves the whole rating
        ratingBox.addEventListener('mouseleave', function () {

            updateStars(selectedRating);

        });


        // Start with all inactive
        updateStars(0);

    });

});
</script>
            
        </div>

        <?php
    }
}