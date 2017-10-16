<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Ima\UI;

use Ima\Routing\Routing;

/**
 * Description of HtmlRepresentation
 *
 * @author lpena
 */
class HtmlRepresentation {
    
    protected $htmlFile;    
    /**
     *
     * @var array 
     */
    public $javascripts = array();
    /**
     *
     * @var array
     */
    public $stylesheets = array();
    /**
     *
     * @var array
     */
    public $items = array();
    
    private $cssClasses = array();
    
    private $visible = true;    
    
    private $attributes = [];
    /**
     *
     * @var \Ima\UI\HtmlRepresentation
     */
    private $parent;
    
    private $text;
    
    public function __construct($htmlFile) {
        $this->htmlFile = $htmlFile;
    }
    
    public function getHtmlFile() {
        return Routing::getRoot() . $this->htmlFile;
    }
    
    public function setHtmlFile($htmlFile) {
        $this->htmlFile = $htmlFile;
        return $this;
    }

        /**
     * Embeds the html representation to the UI
     * @param \Ima\UI\HtmlRepresentation $htmlObject
     */
    public function embedObject(\Ima\UI\HtmlRepresentation $htmlObject) {        
        extract(array('object'=>$htmlObject));
        include $htmlObject->getHtmlFile();       
        return $this;
    }
    /**
     * Output the html object
     */
    public function output() {
        extract(array('object'=>$this));
        include $this->getHtmlFile();       
        return $this;
    }
    /**
     * Add a javascript file related to the html
     * @param Javascript $javascript
     */
    public function addJavascript($javascript) {        
        array_push($this->javascripts,$javascript);
        return $this;
    }
    /**
     * Add a stylesheet file related to the html
     * @param Stylesheet $stylesheet
     */
    public function addStylesheet($stylesheet) {
        array_push($this->stylesheets,$stylesheet);
        return $this;
    }
    /**
     * Get the javascripts assigned to the html file
     * @return array
     */
    public function getJavascripts() {        
        $jss = $this->loadJavascriptsFromChilds($this->getItems());
        $jssclean = array();
        /* @var $js Javascript */
        foreach($jss as $js) {
            $found = false;
            /* @var $jsi Javascript */
            foreach($jssclean as $jsi) {
                if($jsi->getPath() == $js->getPath()) {
                    $found = true;
                }
            }
            if(!$found) {
                array_push($jssclean, $js);
            }
        }
        return $jssclean;
    }
    /**
     * Get the stylesheets assigned to the html file
     * @return array
     */
    public function getStylesheets() {        
        $csss = $this->loadStylesheetsFromChilds($this->getItems());
        $csssclean = array();
        /* @var $css Stylesheet */
        foreach($csss as $css) {
            $found = false;
            /* @var $cssi Stylesheet */
            foreach($csssclean as $cssi) {
                if($cssi->getPath() == $css->getPath()) {
                    $found = true;
                }
            }
            if(!$found) {
                array_push($csssclean, $css);
            }
        }
        return $csssclean;
    }
    /**
     * 
     * @param \Ima\UI\HtmlRepresentation $items
     * @return type
     */
    private function loadJavascriptsFromChilds(array $items) {        
        $childJs = array();
        foreach($this->javascripts as $js) {
            $childJs[] = $js;
        }
        /* @var $items \Ima\UI\HtmlRepresentation */
        foreach($items as $item){   
            if($item != NULL) {
                $jss = $item->getJavascripts();            
                if(count($jss)>0) {
                    foreach($jss as $js){
                        $childJs[] = $js;
                    }
                }
            }
        }        
        return $childJs;
    }
    /**
     * 
     * @param \Ima\UI\HtmlRepresentation $items
     * @return type
     */
    private function loadStylesheetsFromChilds(array $items) { 
        $childCss = array();
        foreach($this->stylesheets as $css) {
            $childCss[] = $css;
        }
        /* @var $items \Ima\UI\HtmlRepresentation */
        foreach($items as $item){   
            if($item != NULL) {
                $csss = $item->getStylesheets();            
                if(count($csss)>0) {
                    foreach($csss as $css){
                        $childCss[] = $css;
                    }
                }
            }
        }        
        return $childCss;
    }
    /**
     * Add an HtmlRepresentation item 
     * @param $item
     */
    public function addItem($item) {
        /* @var $item \Ima\UI\HtmlRepresentation */
        if($item != NULL) {
            $item->setParent($this);
            array_push($this->items,$item);
        }
        return $this;
    }    
    /**
     * 
     * @param array $items
     */
    public function setItems($items) {
        $this->items = $items;
        return $this;
    }
    /**
     * 
     * @return array
     */
    public function getItems() {
        return $this->items;
    }
    
    public function getItemByName($name) {
        /* @var $item FormField */
        foreach($this->items as $item) {
            if($item->getName()==$name) {
                return $item;
            }
        }
    }
    /**
     * 
     * @return \Ima\UI\HtmlRepresentation
     */
    public function clearItems() {
        $this->items = array();
        return $this;
    }
    /**
     * 
     * @return string
     */
    public function getCssclass() {
        return implode(" ", $this->cssClasses);
    }
    /**
     * Adds a css class to be added to the html representation of the object
     * @param string $cssclass
     * @return \Ima\UI\HtmlRepresentation
     */
    public function addCssClass($cssclass) {
        array_push($this->cssClasses, $cssclass);        
        return $this;
    }
    /**
     * Gets the visible current state of the object
     * @return type
     */
    public function getVisible() {
        return $this->visible;
    }
    /**
     * Sets the visible state of the html object
     * @param type $visible
     * @return \Ima\UI\HtmlRepresentation
     */
    public function setVisible($visible) {
        $this->visible = $visible;
        return $this;
    }
    /**
     * 
     * @return \Ima\UI\HtmlRepresentation
     */
    public function getParent() {
        return $this->parent;
    }
    /**
     * 
     * @param \Ima\UI\HtmlRepresentation $parent
     */
    public function setParent(\Ima\UI\HtmlRepresentation $parent) {
        $this->parent = $parent;
        return $this;
    }

    public function getCssClasses() {
        return $this->cssClasses;
    }

    public function getAttributes() {
        return $this->attributes;
    }
    
    public function outputAttributesString() {
        $output = "";
        $space = "";
        foreach($this->getAttributes() as $att) { 
            $output .= $space . key($att)."='".$att[key($att)]."'";
            $space = " ";
        }
        echo $output;
    }
    
    public function setCssClasses(array $cssClasses) {
        $this->cssClasses = $cssClasses;
        return $this;
    }

    public function setAttributes(array $attributes) {
        $this->attributes = $attributes;
        return $this;
    }
    
    public function addAttribute(array $attribute) {
        array_push($this->attributes,$attribute);
        return $this;
    }

    public function getText() {
        return $this->text;
    }
    
    public function setText($text) {
        $this->text = $text;
        return $this;
    }




}
