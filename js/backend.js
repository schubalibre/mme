$(document).ready(function () {

    $("a[href*='/update/']").on("click",function(e){
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

        var values = $self.serialize();
        values = values.concat($self.find('input[type=checkbox]:not(:checked)').map(function(){return "&" + this.name + "=0"}).get());

        $.ajax({
            type: "POST",
            url: url,
            data: values, // serializes the form's elements.
            dataType: "json"
        }).done(function(json) {
            $self.html("<div class='modal-body'><div class='alert alert-success' role='alert'><h2 class='text-center'>" + json.msg + "</h2></div></div>");
            window.setTimeout(function(){location.reload()},1000);
        }).fail(function (jqXHR, textStatus, errorThrown) {
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