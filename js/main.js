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


    $('.category-links a').click(function (event) {
        event.preventDefault();

        var $category = $(this),
            $filterDiv = $("#" + $category.parents("ul").data("filterFor")),
            link = $category.attr('href');

        link = link.substr(1, link.length)

        $('.nav-pills a').parent().removeClass("active");

        $category.parent().addClass("active");

        $filterDiv.find("div").each(function (index, element) {
            if (link == "") {
                $(element).fadeTo(300, 1);
                return true;
            }

            if ($(element).hasClass(link)) {
                $(element).fadeTo(300, 1);
            } else {
                $(element).fadeTo(300, 0.3);
            }
        });
    });

    var $grid = $('.product-items').masonry({
        // options
        itemSelector: '.product-item',
    });

    $(document).on("click", "a.product-modal-link", function (e) {
        e.preventDefault();
        $a = $(this);
        $.ajax({
            url: $a.attr("href"),
            method: "GET",
            dataType: "json"
        }).done(function (ajax) {
            console.log(ajax);
            if (ajax.room != undefined) {
                $('#myModal').modal({show: generateRoomModal(ajax.room)});
            } else if (ajax.article != undefined) {
                $('#myModal').modal({show: generateArticleModal(ajax.article)});
            }
        }).fail(function () {
            alert("error");
        });
    });

    $("#login").on("click",function(e){
        e.preventDefault();
        $('#loginModal').modal({show: true});
    });


    $("#loginForm").submit(function(e){

        var $self = $(this);

        var url = $self.attr("action");
        console.log(url);
        $.ajax({
            type: "POST",
            url: url,
            data: $self.serialize(), // serializes the form's elements.
            dataType: "json"
        }).done(function(ajax) {
            if(ajax.client.authentication){
                window.location.href = "/backend";
            }else{
                alert(ajax);
            }

        }).fail(function () {
                alert("error");
        });

        e.preventDefault();
    });


    /* Delete admin*/
    $(".delete").click(function (event) {
        var element = $(this).data('deleteElement');
        return confirm('Willst du wirklich ' + element + ' löschen?');
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

function generateRoomModal(room) {
    $(".modal-title").html(room.name);

    $img = $("<img class='img-responsive' src='/images/" + room.img + "' alt=''>");
    $title = $("<h3>" + room.title + "</h3>");
    $description = $("<p>" + room.description + "</p>");

    $ul = $("<ul class='article-ul'>");

    if (room.articles != null) {
        $.each(room.articles, function (index, article) {
            $li = $("<li>");
            $li.append();
            $articleImg = $("<img class='img-responsive' src='/images/thumbnails/thumb_" + article.img + "' alt=''>");
            $li.append($("<a class='product-modal-link' href='/home/article/" + article.id + "'>").append($articleImg));
            $ul.append($li);
        });
    }

    $(".modal-img").empty().append($img);
    $('.modal-body').empty().append($title).append($description).append($ul);

    $img.load(function () {
        return true;
    });
}

function generateArticleModal(article) {

    $(".modal-title").html(article.name);

    $img = $("<img class='img-responsive' src='/images/" + article.img + "' alt=''>");
    $title = $("<h3>" + article.title + "</h3>");
    $description = $("<p>" + article.description + "</p>");

    $roomImg = $("<img class='img-responsive' src='/images/thumbnails/thumb_" + article.room.img + "' alt=''>");

    var $ul = $("<ul class='article-ul'>")
        .append($("<li>").append("Raum: ").append($("<a class='product-modal-link' href='/home/room/" + article.room.id + "'>").append($roomImg)))
        .append("<li>gefunden bei: <a href='" + article.website + "'>" + article.shop + "</a></li>");

    $(".modal-img").empty().append($img);
    $('.modal-body').empty().append($title).append($description).append($ul);


    $img.load(function () {
        return true;
    });
}