/*$.ajax({
    method : "post",
    url: "http://mme.local/admin/department/",
    context: { name: "John", location: "Boston" },
    dataType: "html"
}).done(function(html) {
    console.log(html);
}).fail(function( jqXHR, textStatus ) {
    console.log(jqXHR);
    alert( "Request failed: " + textStatus );
});*/

console.log($(".delete"));

$(".delete").click(function(event){
    var element = $(this).data('deleteElement');
    return confirm('Willst du wirklich ' + element + ' löschen?' );
});

