function fillProductForm(data){

    var department = data.department;

    if(department != undefined || department != null) {

        $("#productFormModal").find(".modal-title").html("Department aktualisieren");

        $("#productFormModal").find("form").attr("action", "/department/update/" + department.id);
        $('#id').val(department.id);
        $('#name').val(department.name);
    }else{

        $("#productFormModal").find(".modal-title").html("neues Department");
        $('#id').val("");
        $('#name').val("");
    }

    return true;
}
