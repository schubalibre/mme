function fillProductForm(data){

    var article = data.article;

    if(article != undefined || article != null) {

        $("#productFormModal").find(".modal-title").html("Artikel aktualisieren");

        $("#productFormModal").find("form").attr("action", "/article/update/" + article.id);

        $('#id').val(article.id);
        $('#category_id').find('option[value=' + article.category_id + ']').attr('selected', 'selected');
        $('#room_id').find('option[value=' + article.room_id + ']').attr('selected', 'selected');
        $('#name').val(article.name);
        $('#title').val(article.title);
        $('#description').val(article.description);
        if (article.img != "") {
            $("#img").prop('required', false)
            $(".updated-img").html('<img src="/images/thumbnails/thumb_' + article.img + '" alt="' + article.img + '"/><input type="hidden" name="img" value="' + article.img + '">');
        }
        $('#shop').val(article.shop);
        $('#website').val(article.website);
    }else{
        $("#productFormModal").find(".modal-title").html("neuer Artikel");

        $('#id').val("");
        $('#category_id').find('option:selected').prop("selected", false);
        $('#room_id').find('option:selected').prop("selected", false);
        $('#name').val("");
        $('#title').val("");
        $('#description').val("");
        $(".updated-img").html("");
        $('#shop').val("");
        $('#website').val("");
    }

    return true;
}