





$( document ).ready(function() {
    /*$.ajax({
     method : "post",
     url: "http://mme.local/admin/department/",
     context: { name: "John", location: "Boston" },
     dataType: "html"
     }).done(function(html) {
     console.log(html);
     }).fail(function( jqXHR, textStatus ) {
     console.log(jqXHR);
     alert( "Request failed: " + textStatus );
     });*/

    var scrollTop = $(document).scrollTop(); // Scrollposition des Users
    var height = $("#myCarousel").outerHeight(); // Höhe des Bildes holen
    var $nav = $("#myNav"); // Header holen

    $nav.addClass("navbar-fixed-bottom transparente")

    if (scrollTop > height) { // Scroll Position größer als das Bild -> small Klasse im CSS // wird beim Neuladen als erstes überprüft
        $nav.removeClass("navbar-fixed-bottom transparente").addClass("navbar-fixed-top smaller");
    }else{
        $nav.css({bottom:$(document).scrollTop()});
    }

    $( window ).scroll(function() {

        scrollTop = $(document).scrollTop();

        if ((scrollTop + $nav.outerHeight()) > height) {
            $nav.removeClass("navbar-fixed-bottom transparente").addClass("navbar-fixed-top smaller");
            $nav.css({bottom:""});
        } else {
            $nav.removeClass("navbar-fixed-top smaller").addClass("navbar-fixed-bottom transparente");
            $nav.css({bottom:$(document).scrollTop()}); // falls User wieder über das Bild nach oben scrollt -> Header wieder groß
        }
    });

    /* Delete admin*/
    $(".delete").click(function(event){
        var element = $(this).data('deleteElement');
        return confirm('Willst du wirklich ' + element + ' löschen?' );
    });
});

