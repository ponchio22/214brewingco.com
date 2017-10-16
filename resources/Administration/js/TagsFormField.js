(function($){
    
    var TagsFormField = function(element) {
        this.$element = $(element);
        this.$sampleTag = this.$element.find("#"+this.$element.attr("id")+"_tag_sample");        
        this.tags = [];
        this.setup();
    };
    
    TagsFormField.prototype = {
        
        setup: function() {
            var that = this;
            that.$element.find(".tagsFormFieldItem").each(function() {
                that.setupTag($(this));
            });
            return this;
        },
        
        addTag: function(label) {            
            var clone = this.$sampleTag.clone().attr("id","");
            clone.find(".tag_label").text(label);
            this.setupTag(clone);
            this.$sampleTag.parent().append(clone.show());
            return this;
        },
        
        setupTag: function(tag) {            
            var that = this;
            this.tags.push(tag.find(".tag_label").text());
            $(tag).find("a").click(function(e) {
                e.preventDefault();
                var label =$(this).parent().find(".tag_label").text();
                $(this).parent().remove();                
                var i = that.tags.indexOf(label);
                if(i != -1) {
                    that.tags.splice(i, 1);
                }
                that.$element.trigger("tagRemoved",[label,that.$element]);
            });            
        },
        
        getTags: function() {
            return this.tags;
        }
        
    };
    
    $.fn.getTagsFormFieldTags = function() {
        return $(this).tagsFormField().data("tagsFormField").getTags();
    };
    
    $.fn.tagsFormField = function() {
        return this.each(function () {
            var $this = $(this),
                data = $this.data('tagsFormField');
            if (!data)
                $this.data('tagsFormField', (data = new TagsFormField(this)));
        });
    };
    
}(jQuery));

$(function() {
    $(".tagsFormField").tagsFormField();
});