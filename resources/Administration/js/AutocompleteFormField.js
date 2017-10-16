(function ($) {

    /**
    * Creates a new autocomplete form field with the element supplied as a parameter
    * @type type
    */
    var AutocompleteFormField = function(element) {
        var that = this;
        that.$element = $(element);
        that.$helpBlockContainer = that.$element.closest(".form-row");
        that.$helpBlock = that.$helpBlockContainer.find(".help-block");
        that.$clearButton = that.$helpBlockContainer.find(".clear_button");
        that.typed = false;
        that.setup();
    };

    /**
     * Properties and methods of the autocomplete form field object
     */
    AutocompleteFormField.prototype = {
        
        dataBindAttribute: "data-bind",
        
        notFoundMessageAttribute: "notfound-msg",
        
        indicateMessageOnChangeAttribute: "indicate-onchange",
        
        setup: function() {
            this.$element.on("click",$.proxy(this.handleClick,this))
                    .on("blur",$.proxy(this.handleChange,this))
                    .on("keypress",$.proxy(this.handleKeyPress,this));
            this.$element.typeahead({
                source:{},
                autoSelect:false,
                onSelect: $.proxy(this.handleTypeaheadOnSelect,this),
                onNoSelect: $.proxy(this.handleTypeaheadOnNoSelect,this)
            });
            this.$clearButton.on("click",$.proxy(this.clearField,this));            
            this.refreshSource();
        },
        
        handleClick: function() {
            this.$element.select();
        },
        
        handleKeyPress: function() {            
            this.typed = true;
        },
        
        handleTypeaheadOnSelect: function(value,text) {            
            if(this.$element.val()=="") {
                this.hideMessage();
            } else {                
                var found = false,
                        itemFound,
                        value = this.$element.val();
                this.$element.data("typeahead").source.forEach(function(item) {                    
                    if(item.name==value) {
                        found = true;
                        itemFound = item;                        
                    }
                });                
                if(this.$element.attr(this.indicateMessageOnChangeAttribute)=="1") {                    
                    found? this.hideMessage():this.showWarning();
                }
                if(!found) {
                    itemFound = {id:this.$element.val(),name:this.$element.val()};
                }
                this.hideMessage();                      
                this.$element.trigger("selectionChange",[found,itemFound,this.$element]);
            }
        },
        
        handleTypeaheadOnNoSelect: function() {
            if(this.$element.val()=="") {                            
                this.$element.trigger("selectionCleared");
                this.hideMessage();
            } else {
                if(this.$element.attr(this.indicateMessageOnChangeAttribute)=="1") {
                    this.showWarning();
                }
                var itemFound = {id:this.$element.val(),name:this.$element.val()};                            
                this.$element.trigger("selectionChange",[false,itemFound,this.$element]);      
            }
        },
        
        refreshSource: function() {
            var dataBind = this.$element.attr(this.dataBindAttribute);            
            $.post(dataBind,$.proxy(this.handleSourceRefreshed,this));
        },
        
        handleSourceRefreshed: function(response) {
            this.$element
                    .off("blur",$.proxy(this.handleChange,this))
                    .off("keypress",$.proxy(this.handleKeyPress,this));
            var parsed = JSON.parse(response);
            this.$element.data("typeahead").source = parsed;
            if(this.$element.val()!="" && this.typed) {
                this.$element.data("typeahead").lookup();
            }
        },
        
        clearField: function() {
            var that = this;
            if(that.$element.val()!="") {            
                that.$element.val("");
                var itemFound = {id:"",name:""};
                that.$element.trigger("selectionChange",[false,itemFound,that.$element]);
                that.hideMessage();
            }
        },
        
        handleChange: function() {
            var that = this;
            var itemFound = {id:that.$element.val(),name:that.$element.val()};                            
            that.$element.trigger("selectionChange",[false,itemFound,that.$element]); 
        },
        
        hideMessage: function() {
            var that = this;
            that.$helpBlockContainer.removeClass("has-warning").removeClass("has-error");
            that.$helpBlock.hide().text("");
            return this;
        },
        
        showWarning: function() {
            var that = this;
            that.$helpBlockContainer.addClass("has-warning").removeClass("has-error");
            that.$helpBlock.show().text(that.$helpBlock.attr(that.notFoundMessageAttribute).toString());
            return this;
        }
    };

    /**
     * Plugin definition
     * @returns {AutocompleteFormField_L1.$.fn}
     */
    $.fn.autocompleteFormField = function() {
        return this.each(function () {
            var $this = $(this),
                data = $this.data('autocompleteFormField');
            if (!data)
                $this.data('autocompleteFormField', (data = new AutocompleteFormField(this)));
        });
    };
 
}(jQuery));

$(function(){    
    $(".autocompleteFormField").autocompleteFormField();
});