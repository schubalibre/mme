$(document).ready(function () {
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
        itemSelector: '.product-item'
    });

    $(document).on("click", "a.product-modal-link", function (e) {
        e.preventDefault();
        $a = $(this);
        $.ajax({
            url: $a.attr("href"),
            method: "GET",
            dataType: "json"
        }).done(function (ajax) {
            if (ajax.room != undefined) {
                $('#productModal').modal({show: generateRoomModal(ajax.room)});
            } else if (ajax.article != undefined) {
                $('#productModal').modal({show: generateArticleModal(ajax.article)});
            }
        }).fail(function () {
            alert("error");
        });
    });

    $("a[href='/backend/login']").on("click",function(e){
        e.preventDefault();
        $('#loginModal').modal({show: true});
    });

    $("#loginForm").submit(function(e){
        var $self = $(this);
        var url = $self.attr("action");
        $.ajax({
            type: "POST",
            url: url,
            data: $self.serialize(), // serializes the form's elements.
            dataType: "json"
        }).done(function(json) {
            if(json.client.authentication){
                window.location.href = "/backend";
            }else{
                alert(json);
            }

        }).fail(function () {
            alert("error");
        });

        e.preventDefault();
    });
});

function generateRoomModal(room) {

    var $myModal =  $('#productModal');

    $(".modal-title", $myModal).html(room.name);

    $img = $("<img class='img-responsive' src='/images/" + room.img + "' alt=''>");
    $title = $("<h4>" + room.title + "</h4>");
    $description = $("<p>" + room.description + "</p><p>Dazugehörige Artikel:</p>");

    $ul = $("<ul class='row'>");

    if (room.articles != null) {
        $.each(room.articles, function (index, article) {
            $li = $("<li class='col-lg-4 col-md-4 col-sm-6 col-xs-6'>");
            $li.append();
            $articleImg = $("<img class='img-responsive' src='/images/thumbnails/thumb_" + article.img + "' alt=''>");
            $li.append($("<a class='product-modal-link' href='/home/article/" + article.id + "'>").append($articleImg));
            $ul.append($li);
        });
    }

    $("#img-content", $myModal).empty().append($img);
    $('#product-content', $myModal).empty().append($title).append($description).append($ul);

    $img.load(function () {
        return true;
    });
}

function generateArticleModal(article) {

    var $myModal =  $('#productModal');

    $(".modal-title", $myModal).html(article.name);

    $img = $("<img class='img-responsive' src='/images/" + article.img + "' alt=''>");
    $title = $("<h4>" + article.title + "</h4>");
    $description = $("<p>" + article.description + "</p>");

    $roomImg = $("<img class='img-responsive' src='/images/thumbnails/thumb_" + article.room.img + "' alt=''>");

    var $ul = $("<ul class='row'>")
        .append($("<li class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>").append("Raum: ").append($("<a class='product-modal-link' href='/home/room/" + article.room.id + "'>").append($roomImg)))
        .append("<li class='col-lg-6 col-md-6 col-sm-6 col-xs-6'> gefunden bei: <a href='" + article.website + "'>" + article.shop + "</a></li>");

    $("#img-content", $myModal).empty().append($img);
    $('#product-content', $myModal).empty().append($title).append($description).append($ul);

    $img.load(function () {
        return true;
    });
}