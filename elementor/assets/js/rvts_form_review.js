jQuery(document).ready(function ($) {

    $('.rvts-rating').each(function () {

        const ratingBox = $(this);
        const stars = ratingBox.find('.rvts-star');

        const ratingInput = ratingBox
            .closest('.rvts-form-group')
            .find('.rvts-rating-value');

        let selectedRating = 0;


        /*
         * ==========================================
         * UPDATE STARS
         * ==========================================
         */

        function updateStars(rating) {

            stars.each(function () {

                const star = $(this);

                const starRating = parseInt(
                    star.attr('data-rating'),
                    10
                );

                if (starRating <= rating) {

                    star.attr(
                        'src',
                        star.attr('data-active-src')
                    );

                } else {

                    star.attr(
                        'src',
                        star.attr('data-inactive-src')
                    );

                }

            });

        }


        /*
         * ==========================================
         * HOVER
         * ==========================================
         */

        stars.on('mouseenter', function () {

            const hoverRating = parseInt(
                $(this).attr('data-rating'),
                10
            );

            updateStars(hoverRating);

        });


        /*
         * ==========================================
         * CLICK
         * ==========================================
         */

        stars.on('click', function () {

            selectedRating = parseInt(
                $(this).attr('data-rating'),
                10
            );

            ratingInput.val(selectedRating);

            updateStars(selectedRating);

        });


        /*
         * ==========================================
         * MOUSE LEAVE
         * ==========================================
         */

        ratingBox.on('mouseleave', function () {

            updateStars(selectedRating);

        });


        /*
         * ==========================================
         * RESET RATING
         * ==========================================
         */

        $(document).on('rvts_reset_rating', function () {

            selectedRating = 0;

            ratingInput.val('0');

            updateStars(0);

        });


        /*
         * ==========================================
         * INITIAL STATE
         * ==========================================
         */

        updateStars(0);

    });

});