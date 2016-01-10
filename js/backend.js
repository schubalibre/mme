$(document).ready(function () {

    $("a[href*='/update/'], #new").on("click",function(e){
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json"
        }).done(function(json){
            console.log(json);
            $('#productFormModal').modal({show: fillProductForm(json)});
        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        });
    });

    $("#productFormModal").find("form").submit(function(e){

        var $self = $(this);
        var url = $self.attr("action");
        e.preventDefault();
        //var values = $self.serialize();
        //values = values.concat($self.find('input[type=checkbox]:not(:checked)').map(function(){return "&" + this.name + "=0"}).get());
        var formData  = new FormData(this);
        formData.append("slider",$("#slider").is(':checked') ? 1 : 0);
        $.ajax({
            type: "POST",
            url: url,
            data: formData, // serializes the form's elements.
            processData: false,
            contentType: false,
            dataType: "json"
        }).done(function(json) {
            $self.replaceWith("<div class='modal-body'><h2 class='text-center text-success'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span>" + json.msg + "</h2></div>");
            $('#productFormModal').on('hidden.bs.modal', function (e) {
                location.reload()
            });
        }).fail(function (jqXHR, textStatus, errorThrown) {
            $self.html("<div class='modal-body'><h2 class='text-center text-danger'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span>Ein Fehler ist aufgetreten!</h2></div>");
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        });

        e.preventDefault();
    });

    $(".delete").click(function (event) {
        var element = $(this).data('deleteElement');
        return confirm('Willst du wirklich ' + element + ' löschen?');
    });
});