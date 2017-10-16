$(function( $ ) {
    
    var FileInputFormField = function(element) {
        this.$element = $(element);
        this.$container = this.$element.closest(".fileInputFormFieldContainer")
        this.$selector = this.$container.find(".uploadFileSelector");
        this.$changeButton = this.$container.find(".changeButton");
        this.$rotateLeftButton = this.$container.find(".rotateLeft");
        this.$rotateRightButton = this.$container.find(".rotateRight");
        this.uploadedFilePath = this.$element.attr("file-upload-directory");
        this.ajaxUploadPath = this.$element.attr("ajax-upload-path");    
        this.root = this.$container.data("root");        
        this.currentDegrees = 0;
        this.setup();
    };
    
    FileInputFormField.prototype = {
        
        setup: function() {
            this.$selector.on("change",$.proxy(this.handleSelectorChange,this));
            this.$changeButton.on("click",$.proxy(this.handleChangeClick,this));
            this.$rotateLeftButton.on("click",$.proxy(this.handleRotationClick,this,-90));
            this.$rotateRightButton.on("click",$.proxy(this.handleRotationClick,this,90));
        },
        
        handleRotationClick: function(degrees,e) {            
            $(e.target).find(".spinnerIcon").show().parent().find(".rotateIcon").hide();
            e.preventDefault();
            this.rotateImages(degrees);
        },
        
        rotateImages: function(degrees) {            
            this.currentDegrees += degrees;
            var that = this;
            this.$container.find("img.image").each(function() {
                var formData = {ajax:"1",file:that.$element.val(),"degrees":degrees};
                $.post(this.root + "/image/rotate",formData,$.proxy(that.handleRotationCompleted,that));
            });
        },
        
        handleRotationCompleted: function() {
            this.$container.find(".rotateIcon").show();
            this.$container.find(".spinnerIcon").hide();
            this.setImage(this.$element.val());
        },
        
        handleChangeClick: function() {
            this.$selector.val("");            
            this.$selector.click();
        },
        
        handleSelectorChange: function() {
            var file_data = this.$selector.prop('files')[0];
            var formData = new FormData();            
            formData.append('file_uploads', file_data);            
            formData.append('file_directory',this.uploadedFilePath);
            var that = this;
            $.ajax({
                url: this.ajaxUploadPath,
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                type: 'post',
                success: $.proxy(this.handleUploadResponseHandler,this)
            });
            this.$selector.attr("disabled",true);
        },
        
        handleUploadResponseHandler: function(data) {
            var result = $.parseJSON(data);
            this.$element.trigger("uploaded",[result.file]);
            this.$selector.trigger("uploaded",[result.file]);
            this.$selector.attr("disabled",false);
            this.setImage(result.file);
        },
        
        setImage: function(file) {
            this.$element.val(file);
            this.$container.attr("has-value","1");
            var d = new Date();
            this.$container.find("img").attr("src",this.root + "/image/?file=" + file + "&" + d.getTime());
        }
    };
    
    $.fn.fileInputFormField = function() {
        return this.each(function () {
            var $this = $(this),
                data = $this.data('fileInputFormField');
            if (!data)
                $this.data('fileInputFormField', (data = new FileInputFormField(this)));
        });
    };
    
    $(".fileInputFormField").fileInputFormField();
    
}(jQuery));