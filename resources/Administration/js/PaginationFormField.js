$( function ( $ ) {
    
    var PaginationFormField = function(element) {
        this.$element = $(element);
        this.limit = this.$element.data("limit");
        this.total = this.$element.data("total");
        this.offset = this.$element.data("offset");
        this.followLinks = this.$element.data("follow-links");
        this.currentPath = this.$element.data("current-path");
        this.setup();
    };
    
    PaginationFormField.prototype = {
        
        setup: function() {
            var that = this;
            this.$element.find("a").on("click",$.proxy(this.handlePageClicked,this));            
        },
        
        handlePageClicked: function(e) {            
            if(!this.followLinks) {
                e.preventDefault();                    
            }
            this.$element.trigger("pageChanged",this.currentPath + $(e.target).attr("href"));
        },
        
        setTotal: function(total) {
            this.total = total;
            return this;
        },
        
        setLimit: function(limit) {
            this.limit = limit;
            return this;
        },
        
        setOffset: function(offset) {
            this.offset = offset;
            return this;
        }
        
    };
    
    $.fn.paginationFormField = function() {
        return this.each(function () {
            var $this = $(this),
                data = $this.data('paginationFormField');
            if (!data)
                $this.data('paginationFormField', (data = new PaginationFormField(this)));
        });
    }
    
    $(".pagination-container").paginationFormField();
    
}(jQuery));