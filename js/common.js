(function ($) {
    "use strict";
    /*-------------------------------------
    Instagram Photos
    -------------------------------------*/
    function cp_instagram_photos() {
        $('.cp-instagram-photos').each(function(){
            $.instagramFeed({
                'username': $(this).data('username'),
                'container': $(this),
                'display_profile': false,
                'display_biography': false,
                'items': $(this).data('items'),
                'margin': 0
            });
            console.log( $(this) );
        });

    }
    cp_instagram_photos();
})(jQuery);	