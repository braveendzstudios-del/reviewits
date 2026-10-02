<?php

class rvts_review_stars extends \Elementor\Widget_Base {

    public function get_name() {

        return 'rvts_review_stars';
    }


    public function get_title() {

        return esc_html__(
            'Review Stars',
            'reviewits'
        );
    }


    public function get_icon() {

        return 'eicon-star';
    }


    public function get_categories() {

        return [ 'reviewits' ];
    }


    protected function register_controls() {

        $this->start_controls_section(
            'review_stars_section',
            [
                'label' => esc_html__(
                    'Review Stars',
                    'reviewits'
                ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $field_options =
            ( new rvts_get_review_field_options() )->get();


        $this->add_control(
            'field_id',
            [
                'label' => esc_html__(
                    'Review Field',
                    'reviewits'
                ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => $field_options,
                'default' => '',
            ]
        );


        $this->end_controls_section();
    }


    protected function render() {

        $settings = $this->get_settings_for_display();


        $field_id = isset( $settings['field_id'] )
            ? sanitize_key( $settings['field_id'] )
            : '';


        if ( ! $field_id ) {

            return;
        }


        $review_id = rvts_review_context::get();


        if ( ! $review_id ) {

            return;
        }


        $fields = ( new rvts_get_review_fields() )->get(
            $review_id
        );


        if ( empty( $fields ) ) {

            return;
        }


        foreach ( $fields as $field ) {

            if (
                isset( $field['field_id'] ) &&
                $field['field_id'] === $field_id
            ) {

                $rating = absint(
                    $field['field_value']
                );


                if ( $rating < 1 ) {

                    return;
                }


                if ( $rating > 5 ) {

                    $rating = 5;
                }


                echo '<div class="rvts-review-stars" aria-label="' .
                    esc_attr(
                        sprintf(
                            esc_html__(
                                '%d out of 5 stars',
                                'reviewits'
                            ),
                            $rating
                        )
                    ) .
                    '">';


                for ( $i = 1; $i <= 5; $i++ ) {

                    if ( $i <= $rating ) {

                        echo '<span class="rvts-star rvts-star-filled">★</span>';

                    } else {

                        echo '<span class="rvts-star rvts-star-empty">☆</span>';
                    }
                }


                echo '</div>';


                return;
            }
        }
    }
}