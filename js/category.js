function fillProductForm(data){

    var category = data.category;

    if(category != undefined || category != null) {

        $("#productFormModal").find("form").attr("action", "/category/update/" + category.id);
        $('#id').val(category.id);
        $('#name').val(category.name);
    }

    return true;
}
