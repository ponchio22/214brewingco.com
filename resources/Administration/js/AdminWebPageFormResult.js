var AdminWebPageFormResult = {    
        
    id: "#informationContainer",
    
    css: ["alert-success","alert-danger","alert-info"],
    
    setup: function() {
        $(AdminWebPageFormResult.id).find(".close").click(function(){
            AdminWebPageFormResult.hide();
        })
    },
    
    show: function() {        
        $(AdminWebPageFormResult.id).show(400);
        return this;
    },
    
    hide: function() {
        $(AdminWebPageFormResult.id).hide(400);
        return this;
    },
    
    setSuccess: function(success) {
        var c = (success)? AdminWebPageFormResult.css[0]:AdminWebPageFormResult.css[1];
        $(AdminWebPageFormResult.id)
                .find(".alert")
                .removeClass(AdminWebPageFormResult.css.join(" "))
                .addClass(c)
                .find(".message")
                .html((success)? "":"<strong>Se encontraron errores!</strong>");        
        return this;
    },
    
    addMessage: function(message) {
        $(AdminWebPageFormResult.id).find(".message").append(message);
        return this;
    },
    
    setProcessing: function() {
        $(AdminWebPageFormResult.id)
                .find(".alert")
                .removeClass(AdminWebPageFormResult.css.join(" "))
                .addClass(AdminWebPageFormResult.css[2])
                .find(".message")
                .html("<strong><span class='fa fa-spinner fa-spin'></span> Procesando...</strong>");   
        return this;
    }
    
};

$(document).ready(AdminWebPageFormResult.setup);