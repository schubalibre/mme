function fillProductForm(data){

    var department = data.department;

    if(department != undefined || department != null) {

        $("#productFormModal").find("form").attr("action", "/department/update/" + department.id);
        $('#id').val(department.id);
        $('#name').val(department.name);
    }

    return true;
}
