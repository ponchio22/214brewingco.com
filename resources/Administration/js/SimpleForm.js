$(document).ready(function() {   
    $('.date_picker').datepicker({
        todayHighlight:true,
        autoclose:true        
    });  
})

$('.checkboxSubmit').on('click',function() {
    $(this).closest('form').submit();
})

$(document).ready(function () {
    $('.actualizarButton').hide();
});
