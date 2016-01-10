function fillProductForm(data){

    var category = data.category;

    if(category != undefined || category != null) {

        $("#productFormModal").find(".modal-title").html("Kategorie aktualisieren");

        $("#productFormModal").find("form").attr("action", "/category/update/" + category.id);
        $('#id').val(category.id);
        $('#name').val(category.name);
    }else{
        $("#productFormModal").find(".modal-title").html("neue Kategorie");
        $('#id').val("");
        $('#name').val("");
    }

    return true;
}
