$(function () {
    
    var UserHomePageContent = function(element) {
        this.$element = $(element);
        this.$pedidos = this.$element.find(".pedidosListaFormField");
        this.$pagoNuevoBtn = $(".nuevoPagoBtn");
        this.$pagoNuevoForm = this.$element.find(".PagoNuevoForm");
        this.$pagosLista = this.$element.find(".pagosListaFormField");
        this.setup();
    };
    
    UserHomePageContent.prototype = {
        
        setup: function() {            
            this.$pedidos.on("processing",$.proxy(this.handlePedidoProcessing,this));
            this.$pedidos.on("success",$.proxy(this.handlePedidoSuccess,this));
            this.$pedidos.on("error",$.proxy(this.handlePedidoError,this));
            this.$pagoNuevoBtn.on("click",$.proxy(this.handlePagoNuevoClick,this));
            this.$pagoNuevoForm.on("success",$.proxy(this.handleAgregarPagoSuccess,this));
        },
        
        handlePagoNuevoClick: function(e) {
            e.preventDefault();
            this.$pagoNuevoForm.data("pagoNuevoForm").popup();
        },
        
        handleAgregarPagoSuccess: function(e,id,message) {
            AdminWebPageFormResult.setSuccess(true).addMessage(message).show();;
            location.reload();
        },
        
        handlePedidoProcessing: function() {            
            AdminWebPageFormResult.setProcessing().show();
        },
        
        handlePedidoSuccess: function(e, message) {
            AdminWebPageFormResult.setSuccess(true).addMessage(message).show();
        },
        
        handlePedidoError: function(e, message) {
            AdminWebPageFormResult.setSuccess(false).addMessage(message).show();
        }
        
    };
    
    $.fn.userHomePageContent = function() {
        return this.each(function () {
            var $this = $(this),
                data = $this.data('userHomePageContent');
            if (!data)
                $this.data('userHomePageContent', (data = new UserHomePageContent(this)));
        });
    }
    
}(jQuery));

$(function() {
    $("body").userHomePageContent();
});