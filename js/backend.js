$(document).ready(function () {

    $("a[href*='/update/'], #new").on("click",function(e){
        e.preventDefault();
        var url = $(this).attr("href");
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json"
        }).done(function(json){
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
        var formData  = new FormData(this);

        formData.append("slider",$("#slider").is(':checked') ? "1" : "0");
        $.ajax({
            type: "POST",
            url: url,
            data: formData, // serializes the form's elements.
            processData: false,
            contentType: false,
            dataType: "json"
        }).done(function(json) {
            console.log(json);

            // Validation rausnehmen
            $self.find(".form-group").removeClass("has-error");
            $self.find("span.help-block").empty();

            if(json.errors){
                if(json.errors.validationErrors){

                    $.each(json.errors.validationErrors,function($field,$error){

                        var $formGroup = $("input[name='" + $field + "'], select[name='" + $field + "'], textarea[name='" + $field + "']").parents(".form-group");

                        $formGroup.addClass("has-error");

                        $formGroup.find("span.help-block").html($error);

                    });

                    delete json.errors.validationErrors;
                }
                $.each(json.errors,function($error,$msg){
                    alert($msg);
                });
            }else{
                $self.replaceWith("<div class='modal-body'><h2 class='text-center text-success'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span>" + json.msg + "</h2></div>");
            }
        }).fail(function (jqXHR, textStatus, errorThrown) {
            $self.html("<div class='modal-body'><h2 class='text-center text-danger'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span>Ein Fehler ist aufgetreten!</h2></div>");
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        });

        $('#productFormModal').on('hidden.bs.modal', function (e) {
            location.reload()
        });

        e.preventDefault();
    });

    $(".delete").click(function (event) {
        var element = $(this).data('deleteElement');
        return confirm('Willst du wirklich ' + element + ' löschen?');
    });
});