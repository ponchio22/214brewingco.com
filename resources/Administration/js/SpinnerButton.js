$(function ($) {
    
    var SpinnerButton = function(element) {
        this.$element = $(element);
        this.$spinner = this.$element.find(".btnSpinner");
        this.$arrow = this.$spinner.next();
        this.setup();
    };
    
    SpinnerButton.prototype = {
        
        setup: function() {
            this.$element.on("click",$.proxy(this.handleButtonClick,this));
        },
        
        handleButtonClick: function(e) {
            this.showSpinner();
        },
        
        showSpinner: function() {
            this.$spinner.show();
            this.$arrow.hide();            
            setTimeout($.proxy(this.disable,this),100);
            setTimeout($.proxy(this.hideSpinner,this),3000);                        
        },
        
        disable: function() {
            this.$element.prop("disabled",true);
        },
        
        hideSpinner: function() {
            this.$spinner.hide();
            this.$arrow.show();
            this.$element.prop("disabled",false);
        }
        
    };
    
    $.fn.spinnerButton = function() {
        return this.each(function () {
            var $this = $(this),
                data = $this.data('spinnerButton');
            if (!data)
                $this.data('spinnerButton', (data = new SpinnerButton(this)));
        });
    };
    
    $("button.spinnerButton").spinnerButton();
    
}(jQuery));