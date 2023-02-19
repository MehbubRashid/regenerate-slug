(function($){
    "use strict";

    $(document).on('click', '.regen-slug', function(e){
        e.preventDefault();

        var permalink = $( '#sample-permalink' ),
			permalinkOrig = permalink.html(),
			buttons = $('#edit-slug-buttons'),
            real_slug = $('#post_name'),
			buttonsOrig = buttons.html();

        $.post(
            ajaxurl,
            {
                action: 'sample-permalink',
                post_id: $('#post_ID').val(),
                new_title: $('#title').val(),
                new_slug: '',
                samplepermalinknonce: $('#samplepermalinknonce').val()
            },
            function(data) {
                var box = $('#edit-slug-box');
                box.html(data);
                if (box.hasClass('hidden')) {
                    box.fadeIn('fast', function () {
                        box.removeClass('hidden');
                    });
                }

                buttons.html(buttonsOrig);
                permalink.html(permalinkOrig);
                real_slug.val('');
                $( '.edit-slug' ).trigger( 'focus' );
            }
        );
    });

})(jQuery);