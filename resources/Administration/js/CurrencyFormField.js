$(function( $ ) {

    var CurrencyFormField = function(element) {
        var that = this;
        that.$element = $(element);
        that.$cashCounter = that.$element.closest(".form-row").find(".cashSumCounterButton");
        that.$cashCounterPanel = that.$cashCounter.closest(".currentyFormFieldContainer").find(".cashSumCounterPanel");
        that.$inputGroup = that.$cashCounter.closest(".currentyFormFieldContainer").find(".currency_field_container").find(".input-group");
        that.$addButton = that.$cashCounterPanel.find(".add");
        that.$cancelButton = that.$cashCounterPanel.find(".cancel");
        that.$useValueButton = that.$cashCounterPanel.find(".useValue");
        that.$totalField = that.$cashCounterPanel.find(".total");
        that.$quantityField = that.$cashCounterPanel.find(".quantity");
        that.$denominationField = that.$cashCounterPanel.find(".denomination");
        that.$currentCountField = that.$cashCounterPanel.find(".conteoActual");
        that.setup();       
    };
    
    CurrencyFormField.prototype = {
        
        setup: function() {            
            this.$element.on("click",$.proxy(this.handleFieldClick,this));
            this.$element.on("change",$.proxy(this.handleFieldChange,this));
            if(this.$cashCounter.length > 0) {
                this.$cashCounter.on("click",$.proxy(this.handleCashCounterClick,this));
                this.$addButton.on("click",$.proxy(this.handleAddClick,this));
                this.$cancelButton.on("click",$.proxy(this.handleCancelClick,this));
                this.$useValueButton.on("click",$.proxy(this.handleUseValueClick,this));
            }
        },
        
        handleFieldClick: function() {
            this.$element.select();
        },
        
        handleFieldChange: function() {
            this.$element.val(this.formatCurrency(this.$element.val()));
        },
        
        handleCashCounterClick: function(e) {
            e.preventDefault();
            this.$cashCounterPanel.show();
            this.$inputGroup.hide();
        },
        
        handleAddClick: function(e) {
            e.preventDefault();
            this.calculateCashSumCounterPanel();
        },
        
        handleCancelClick: function(e) {
            e.preventDefault();
            this.clearCashSumCounter();
        },
        
        handleUseValueClick: function(e) {
            e.preventDefault();                        
            var total = this.$totalField.text();        
            this.$element.val(this.formatCurrency(parseFloat(total)));
            this.clearCashSumCounter();
            this.$cashCounterPanel.hide();
            this.$inputGroup.show();
        },
        
        formatCurrency: function(value){
            return FormatCurrency(value);
        },
        
        calculateCashSumCounterPanel: function() {    
            var qty = parseFloat(this.$quantityField.val());
            var denomination = parseInt(this.$denominationField.val());       
            var total = qty * denomination;           
            if(isNaN(total)) total = 0;    
            var currentValue = parseFloat(this.$totalField.text());    
            this.$totalField.text(this.formatCurrency(currentValue + total));
            this.$quantityField.val(0);
            this.$denominationField.val(this.formatCurrency(0));    
            this.$currentCountField.append('<span class="label label-default">'.concat('$',this.formatCurrency(denomination),' (',qty,')</span> '));
            this.$denominationField.focus().select();
        },
        
        clearCashSumCounter: function() {
            this.$cashCounterPanel.hide();
            this.$inputGroup.show();
            this.$currentCountField.html("");
            this.$totalField.text(this.formatCurrency(0));
        }
        
    };
    
    //Setup the currency form field if it hasnt been setup
    $.fn.currencyFormField = function() {
        return this.each(function () {
            var $this = $(this),
                data = $this.data('currencyFormField');
            if (!data)
                $this.data('currencyFormField', (data = new CurrencyFormField(this)));
        });
    };
    
}(jQuery));

$(function() {
    $(".currency_field").currencyFormField();
});

var FormatCurrency = function(value) {
    var num = parseFloat(value).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1');      
    if(num == 'NaN') {
        num = '0.00';
    }    
    return num;
}