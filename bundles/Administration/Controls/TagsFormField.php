<?php

namespace Administration\Controls;

use Ima\UI\FormField;
use Ima\UI\Javascript;

/**
 * FilterTags
 * @author lpena
 */
class TagsFormField extends FormField {
    
    private $tags = array();
    
    public function __construct($id, $name,$label) {
        parent::__construct($id, $name,$label);
        $this->setHtmlFile("bundles/Administration/views/Ajax/TagsFormField.php");
        $this->addJavascript(new Javascript("resources/Administration/js/TagsFormField.js"));
    }
    
    public function setTags($tags=array()) {
        $this->tags = $tags;
        return $this;
    }
    
    public function getTags() {
        return $this->tags;
    }
}
