$(".form_delete_button").click(function(e) {
    //e.preventDefault();
});

$(".imsure_button").click(function() {
    //$(this).attr("disabled",true);
    
    $(this).closest("form").submit();
});