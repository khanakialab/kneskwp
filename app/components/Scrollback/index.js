function scrollBackButton(elemId) {
    // jQuery(window).on('resize load', function(){
    // });
    
    let $elem= jQuery(elemId);
    $elem.fadeOut();
    jQuery(window).scroll(function(){
        if (jQuery(this).scrollTop() > 300) {
            $elem.fadeIn();
        } else {
            $elem.fadeOut();
        }
    });

    // jQuery("#main-inner").scroll(function(){
    //     if (jQuery(this).scrollTop() > 300) {
    //         $elem.fadeIn();
    //     } else {
    //         $elem.fadeOut();
    //     }
    // });

    //Click event to scroll to top
    jQuery(document).on('click', elemId + ' .back-to-top', function(){
        jQuery('html, body, #main-inner').animate({scrollTop : 0},800);
        return false;
    });
}

window.scrollBackButton = scrollBackButton