$(function ($) {
    
    var MenuItem = function(element) {
        this.$element = $(element);
        this.setup();        
    };
    
    MenuItem.prototype = {
        
        setup: function() {
            this.$element.on("click",$.proxy(this.handleButtonClick,this));
        },
        
        handleButtonClick: function(e) {            
            if(this.$element.data("spinner")=='1') {
                this.showSpinner();
            }
        },
        
        showSpinner: function() {            
            this.$element.find("a").prepend($("<span class='fa fa-spinner fa-spin' style='margin-right:5px;'></span>"));
        }
        
    };
    
    $.fn.menuItem = function() {
        return this.each(function () {
            var $this = $(this),
                data = $this.data('menuItem');
            if (!data)
                $this.data('menuItem', (data = new MenuItem(this)));
        });
    };
    
    $("li.MenuItem").menuItem();
    
}(jQuery));