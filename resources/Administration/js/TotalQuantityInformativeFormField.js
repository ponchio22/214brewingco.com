(function ($) {

    /**
    * Creates a new autocomplete form field with the element supplied as a parameter
    * @type type
    */
    var TotalQuantityInformativeFormField = function(element) {
        this.$element = $(element);   
        this.$label = this.$element.find(".total_label");
        this.$quantity = this.$element.find(".text-primary");        
    };

    /**
     * Properties and methods of the form field object
     */
    TotalQuantityInformativeFormField.prototype = {
        
        setLabel: function(label) {
            this.$label.text(label);
        },
        
        setQuantity: function(quantity) {
            var currentValue = parseFloat(this.$quantity.text().replace("$",""));            
            this.$quantity.prop('Counter',currentValue).animate({
                Counter: quantity
            }, {
                duration: 800,
                easing: 'swing',
                step: function (now) {
                    $(this).text("$" + FormatCurrency(Math.ceil(now)));
                }
            });
        }
        
    };

    $.fn.totalQuantityInformativeFormField = function() {
        return this.each(function () {
            var $this = $(this),
                data = $this.data('totalQuantityInformativeFormField');
            if (!data)
                $this.data('totalQuantityInformativeFormField', (data = new TotalQuantityInformativeFormField(this)));
        });
    };
 
}(jQuery));

$(function(){    
    $(".total_quantity_informative_form_field").totalQuantityInformativeFormField();
});