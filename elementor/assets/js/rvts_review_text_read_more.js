jQuery(document).ready(function ($) {

    $(document).on(
        'click',
        '.rvts-review-text-toggle',
        function () {

            const button = $(this);
            const wrapper = button.closest(
                '.rvts-review-text-read-more'
            );

            const shortText = wrapper.find(
                '.rvts-review-text-short'
            );

            const fullText = wrapper.find(
                '.rvts-review-text-full'
            );

            const expanded =
                button.attr('aria-expanded') === 'true';

            if (expanded) {

                shortText.show();
                fullText.hide();

                button
                    .attr('aria-expanded', 'false')
                    .text(
                        button.data('read-more')
                    );

            } else {

                shortText.hide();
                fullText.show();

                button
                    .attr('aria-expanded', 'true')
                    .text(
                        button.data('read-less')
                    );
            }
        }
    );

});