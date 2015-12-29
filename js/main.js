





$( document ).ready(function() {

    var scrollTop = $(document).scrollTop(); // Scrollposition des Users
    var height = $("#myCarousel").outerHeight(); // Höhe des Bildes holen
    var $nav = $("#home .navbar"); // Header holen

    $nav.addClass("navbar-fixed-bottom transparent")

    if (scrollTop > height) { // Scroll Position größer als das Bild -> small Klasse im CSS // wird beim Neuladen als erstes überprüft
        $nav.removeClass("navbar-fixed-bottom transparent").addClass("navbar-fixed-top smaller");
    }else{
        $nav.css({bottom:$(document).scrollTop()});
    }

    $( window ).scroll(function() {

        scrollTop = $(document).scrollTop();

        if ((scrollTop + $nav.outerHeight()) > height) {
            $nav.removeClass("navbar-fixed-bottom transparent").addClass("navbar-fixed-top smaller");
            $nav.css({bottom:""});
        } else {
            $nav.removeClass("navbar-fixed-top smaller").addClass("navbar-fixed-bottom transparent");
            $nav.css({bottom:$(document).scrollTop()}); // falls User wieder über das Bild nach oben scrollt -> Header wieder groß
        }
    });



    $('.category-links a').click(function (event) {
        event.preventDefault();

        var $category = $(this),
            $filterDiv = $("#" + $category.parents("ul").data("filterFor")),
            link = $category.attr('href');

        link = link.substr(1, link.length)

        $('.nav-pills a').parent().removeClass("active");

        $category.parent().addClass("active");

        $filterDiv.find("div").each(function(index, element){
            if(link == ""){
                $(element).fadeTo(300, 1);
                return true;
            }

            if($(element).hasClass(link)){
                $(element).fadeTo(300, 1);
            }else {
                $(element).fadeTo(300, 0.3);
            }
        });
    });

    var $grid = $('.product-items').masonry({
        // options
        itemSelector: '.product-item',
    });

    $(".product-items a").click(function(e){
        e.preventDefault();
        $a = $(this);
        $.ajax({
            url : $a.attr("href"),
            method: "GET",
            dataType: "json"
        }).done(function(ajax) {
            console.log(ajax);
            if(ajax.room != undefined){
                generateRoomModal(ajax.room);
            }else if(ajax.article != undefined){
                generateArticleModal(ajax.article);
            }
        })  .fail(function() {
            alert( "error" );
        });
    });


    /* Delete admin*/
    $(".delete").click(function(event){
        var element = $(this).data('deleteElement');
        return confirm('Willst du wirklich ' + element + ' löschen?' );
    });

});

function generateRoomModal(room){
    $(".modal-title").html(room.name);

    $img = $("<img class='img-responsive' src='/images/" + room.img + "' alt=''>");
    $title = $("<h3>" + room.title + "</h3>");
    $description =  $("<p>" + room.description + "</p>");

    $lft = $("<div class='col-sm-6'></div>").append($img);
    $rht = $("<div class='col-sm-6'></div>").append($title).append($description);

    $row = $("<div class='row'></div>").append($lft).append($rht);

    $('.modal-body').html($row);

    $img.load(function(){
        $('#myModal').modal({show:true});
    });
}

function generateArticleModal(article){
    $(".modal-title").html(article.name);

    $img = $("<img class='img-responsive' src='/images/" + article.img + "' alt=''>");
    $title = $("<h3>" + article.title + "</h3>");
    $description =  $("<p>" + article.description + "</p>");

    $lft = $("<div class='col-sm-6'></div>").append($img);
    $rht = $("<div class='col-sm-6'></div>").append($title).append($description);

    $row = $("<div class='row'></div>").append($lft).append($rht);

    $('.modal-body').html($row);

    $img.load(function(){
        $('#myModal').modal({show:true});
    });
}

