$(document).ready(function () {

    var scrollTop = $(document).scrollTop(); // Scrollposition des Users
    var height = $("#myCarousel").outerHeight(); // Höhe des Bildes holen
    var $nav = $("#home .navbar"); // Header holen

    $nav.addClass("navbar-fixed-bottom transparent")

    if (scrollTop > height) { // Scroll Position größer als das Bild -> small Klasse im CSS // wird beim Neuladen als erstes überprüft
        $nav.removeClass("navbar-fixed-bottom transparent").addClass("navbar-fixed-top smaller");
    } else {
        $nav.css({bottom: $(document).scrollTop()});
    }

    $(window).scroll(function () {

        scrollTop = $(document).scrollTop();

        if ((scrollTop + $nav.outerHeight()) > height) {
            $nav.removeClass("navbar-fixed-bottom transparent").addClass("navbar-fixed-top smaller");
            $nav.css({bottom: ""});
        } else {
            $nav.removeClass("navbar-fixed-top smaller").addClass("navbar-fixed-bottom transparent");
            $nav.css({bottom: $(document).scrollTop()}); // falls User wieder über das Bild nach oben scrollt -> Header wieder groß
        }
    });

    /* smooth slide */
    $('a[href*=#]:not([href=#]):not(.carousel-control)').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top - $(".navbar").outerHeight()
                }, 1000);
                return false;
            }
        }
    });
});