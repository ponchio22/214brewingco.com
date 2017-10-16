$(document).ready(function() {
    $(".showAdvancedOptionsFormField").closest("form").find(".collapse").on("shown.bs.collapse",function() {
        $(this).closest("form").find(".showAdvancedOptionsFormField").find(".glyphicon").removeClass("glyphicon-triangle-bottom").addClass("glyphicon-triangle-top");
    });
    $(".showAdvancedOptionsFormField").closest("form").find(".collapse").on("hidden.bs.collapse",function() {
        $(this).closest("form").find(".showAdvancedOptionsFormField").find(".glyphicon").removeClass("glyphicon-triangle-top").addClass("glyphicon-triangle-bottom");
    });
});