<?php

namespace Ima\Template;

use Ima\UI\Form;
use Ima\UI\HtmlRepresentation;

/**
 * Description of Template
 *
 * @author lpena
 */
class Template extends HtmlRepresentation {
    
    private $blocks = array();
    
    private $currentBlock;
    
    private $templatePath;
    
    public function __construct($templatePath) {
        $this->templatePath = $templatePath;
        $this->htmlFile = $templatePath;
    }
    
    public function setBlock($blockName) {
        if(!array_key_exists($blockName,$this->blocks)) {
            $output = '';
        } else {
            $output = $this->blocks[$blockName];
        }
        echo $output;
    }
    
    public function block($blockName) {
        $this->blockName = $blockName;
        ob_start();
    }
    
    public function endBlock() {
        $this->blocks[$this->blockName] .= ob_get_contents();
        ob_end_clean();
    }
    
    public function send() {
        include $this->templatePath;
    }
    
    public function embed($file,$parameters=array()) {
        extract($parameters);
        include $file;
    }
    
    /**
     * @param HtmlRepresentation $object
     */
    public function embedObject($object) {   
        $page = $object;
        extract(array('object'=>$object,'this'=>$object));  
        if(is_object($page)) {
            include $page->getHtmlFile();
        } else {
            echo "Not an object in the embed Object method in Template";
        }
    }
    
    public function write($text) {
        echo $text;
    }
}
