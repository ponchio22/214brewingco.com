$(function ($) {
    
    var RegresarButton = function(element) {
        this.$element = $(element);
        this.$spinner = this.$element.find(".regresarSpinner");
        this.$arrow = this.$element.find(".regresarArrow");
        this.setup();
    };
    
    RegresarButton.prototype = {
        
        setup: function() {
            this.$element.on("click",$.proxy(this.handleButtonClick,this));
        },
        
        handleButtonClick: function(e) {
            e.preventDefault();      
            this.$spinner.show();
            this.$arrow.hide();
            this.$element.prop("disabled",true);
            window.location = this.$element.attr("previous-url");            
        }
        
    };
    
    $.fn.regresarButton = function() {
        return this.each(function () {
            var $this = $(this),
                data = $this.data('regresarButton');
            if (!data)
                $this.data('regresarButton', (data = new RegresarButton(this)));
        });
    };
    
    $("button.regresarButton").regresarButton();
    
}(jQuery));