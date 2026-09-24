jQuery(document).ready(function ($) {

    $('#rvts-review-form').on('submit', function (event) {

        event.preventDefault();

        const form = this;

        // Collect all form fields, including uploaded files
        const formData = new FormData(form);

        // WordPress AJAX action
        formData.append('action', 'rvts_submit_review');
        formData.append('nonce', rvts_ajax.nonce);

        console.log('Sending form data...');

        $.ajax({

            url: rvts_ajax.ajax_url,
            type: 'POST',
            data: formData,

            // Required for FormData
            processData: false,
            contentType: false,

            success: function (response) {

                console.log('AJAX RESPONSE:', response);

                /*
                 * ==========================================
                 * SUCCESS
                 * ==========================================
                 */

                if (response.success) {

                    alert(
                        'Thank you! Your review has been submitted successfully.'
                    );


                    /*
                     * Reset normal form fields
                     */

                    $('#rvts-review-form')[0].reset();


                    /*
                     * ==========================================
                     * RESET RATING
                     * ==========================================
                     */

                    $('#rvts-review-form .rvts-rating-value').val('0');


                    /*
                     * Reset all stars to inactive
                     */

                    $('#rvts-review-form .rvts-rating').each(function () {

                        const ratingBox = $(this);

                        ratingBox.find('.rvts-star').each(function () {

                            const star = $(this);

                            const inactiveSrc =
                                star.attr('data-inactive-src');

                            if (inactiveSrc) {

                                star.attr(
                                    'src',
                                    inactiveSrc
                                );

                            }

                        });

                    });

                    $(document).trigger('.rvts_reset_rating');

                }


                /*
                 * ==========================================
                 * PHP VALIDATION ERROR
                 * ==========================================
                 */

                else {

                    alert(
                        response.data &&
                        response.data.message
                            ? response.data.message
                            : 'Something went wrong.'
                    );

                }

            },


            /*
             * ==========================================
             * AJAX REQUEST ERROR
             * ==========================================
             */

            error: function (xhr) {

                console.error(
                    'AJAX ERROR:',
                    xhr
                );

                alert(
                    'Something went wrong. Please try again.'
                );

            }

        });

    });

});