$.ajax({
    method : "post",
    url: "http://mme.local/admin/department/",
    context: { name: "John", location: "Boston" },
    dataType: "html"
}).done(function(html) {
    console.log(html);
}).fail(function( jqXHR, textStatus ) {
    console.log(jqXHR);
    alert( "Request failed: " + textStatus );
});