$( document ).ready(function() {

    $("#loadArticle").click(function(e){
        e.preventDefault();

        $btn = $(this).removeClass("btn-primary btn-danger");

        $("#article-load-error").remove();

        $span = $("<span>").addClass("loader").append("<img src='img/ajax-loader.gif' />");

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
        }).fail(function(jqXHR, textStatus) {

            $btn.addClass("btn-danger");
            $btn.before($("<span id='article-load-error' class='label label-danger'>Request failed: " + textStatus + "</span>"));

            console.log( "Request failed: " + textStatus );

        }).always(function(){
            $btn.addClass("btn-primary");
            $span.remove();
        });
    });

    if($(".form-validation")){
        // Alle Labels aus dem Formular in Variable speichern, um sie später zu durchlaufen
        var labels = $('label');

        // Alle Labels werden durchlaufen
        for (var i = 0; i < labels.length; i++) {
            if (labels[i].htmlFor != '') {// haben Labels ein for mit ID des Input Feldes?
                var elem = $(labels[i].htmlFor);
                // Wir holen uns das passende Input Feld
                if (elem)// Gibt es Input Feld mit dieser ID?
                    elem.label = labels[i];
                // Wenn ja: Wir erfahren, welches Label zu welchem Input Feld gehört -> Verbindung
            }
        }

        //wir holen uns unser Formular
        var $form = $(".form-validation");

        // Browser-eigene Validation ausschalten da diese vor dem submit ausgefürht werden - um unsere eigenen Kontrollen durchzuführen
        $form.noValidate = true;

        // beim Abschicken des Formulares wird unsere Funktion validateForm ausgeführt - um die eigenen Kontrollen durchzuführen
        $form.on("submit",validateForm);
    }


});