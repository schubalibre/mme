$( document ).ready(function() {

    $("#loadArticle").click(function(e){
        e.preventDefault();

        $btn = $(this).removeClass("btn-primary");

        $span = $("<span>").addClass("loader").append("<img src='img/ajax-loader.gif' />")

        $btn.before($span);

        $.ajax({
            url: "includes/article.php",
            method: "POST",
            dataType: "json"
        }).done(function(json){

            $btn.addClass("btn-primary");
            $span.remove();

            if(json.length > 0){

                $.each(json,function(i,value){

                    $div = $('<div class="col-sm-6 col-md-3" style="display: none" ><div class="thumbnail"><img class="img-responsive" src="" alt="article" ><div class="caption"> <h3>'+ value.name +'</h3> <p>'+ value.text +'</p> <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p> </div> </div> </div>').appendTo($('#article-row')).fadeIn(800);
                    Holder.run({
                        images: ".img-responsive"
                    });
                });
            }
        }).fail(function(e) {
            console.log(e);
        }).always(function(){
            $btn.addClass("btn-primary");
            $span.remove();
        });
    });
});