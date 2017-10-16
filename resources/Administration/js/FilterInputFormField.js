$(document).ready(function() {
    
    $(".filterInputFormField").change(function(){
        if($(this).attr("auto-submit")=='1') {
            $(this).closest("form").submit();
        }
    });
    
    $(".filterInputFormField").closest(".form-row").find(".filter_clear_button").click(function(e) {
        e.preventDefault();
        if($(this).closest(".form-row").find(".filterInputFormField").val()!="") {
            $(this).closest(".form-row").find(".filterInputFormField").val("").closest("form").submit();
        }
    });
    
});