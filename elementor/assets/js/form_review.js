jQuery(document).ready(function ($) {

    $('.rvts-rating').each(function () {

        const ratingBox = $(this);
        const stars = ratingBox.find('.rvts-star');

        const ratingInput = ratingBox
            .closest('.rvts-form-group')
            .find('.rvts-rating-value');

        let selectedRating = 0;


        // Change star images
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


        // Hover over a star
        stars.on('mouseenter', function () {

            const hoverRating = parseInt(
                $(this).attr('data-rating'),
                10
            );

            updateStars(hoverRating);

        });


        // Click a star
        stars.on('click', function () {

            selectedRating = parseInt(
                $(this).attr('data-rating'),
                10
            );

            ratingInput.val(selectedRating);

            updateStars(selectedRating);

        });


        // Mouse leaves the rating
        ratingBox.on('mouseleave', function () {

            updateStars(selectedRating);

        });


        // Start with all inactive
        updateStars(0);

    });

});