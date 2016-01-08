function fillProductForm(data){

    var room = data.room;

    if(room != undefined || room != null) {

        $("#productFormModal").find("form").attr("action", "/room/update/" + room.id);

        $('#id').val(room.id);
        $('#department_id').find('option[value=' + room.department_id + ']').attr('selected', 'selected');
        $('#client_id').find('option[value=' + room.client_id + ']').attr('selected', 'selected');
        $('#name').val(room.name);
        $('#title').val(room.title);
        $('#description').val(room.description);
        if (room.img != "") {
            $("#img").prop('required', false)
            $(".updated-img").html('<img src="/images/thumbnails/thumb_' + room.img + '" alt="' + room.img + '"/><input type="hidden" name="img" value="' + room.img + '">');
        }
        $('#shop').val(room.shop);
        $('#website').val(room.website);
        $('#slider').prop('checked', room.slider == "1" ? true : false);
    }

    return true;
}