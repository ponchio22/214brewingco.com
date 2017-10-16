var QuantityField = {
    
    setup: function() {
        $(".quantity_field").click(function() {
            $(this).select();
        }).change(function() {
            $(this).val(parseFloat($(this).val()));
        });
        
    }
}

$(document).ready(QuantityField.setup);