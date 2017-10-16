<?php

namespace Administration\Data\Template;

use Ima\Template\Template;
use Ima\UI\Javascript;

/**
 * Structure of and Administration template
 *
 * @author LuisAlfonso
 */
class AdministrationTemplate extends Template {
    
    const TITLE = 'title';
    
    const PAGE_HEADER = 'pageheader';
    
    const STYLE_SHEETS = 'stylesheets';
    
    const JAVASCRIPTS = 'javascripts';
    
    const CONTENT = 'content';
    
    const MESSAGES = 'messages';
    
    const MENU = 'menu';
    
    public function __construct() {
        parent::__construct('bundles/Administration/views/Template/Template.php');           
    }
    
    public function startTitle() {
        $this->block(\Administration\Data\Template\AdministrationTemplate::TITLE);
    }
    
    public function startPageHeader() {
        $this->block(\Administration\Data\Template\AdministrationTemplate::PAGE_HEADER);
    }
    
    public function startStylesheets() {
        $this->block(\Administration\Data\Template\AdministrationTemplate::STYLE_SHEETS);
    }
    
    public function startJavascripts() {
        $this->block(\Administration\Data\Template\AdministrationTemplate::JAVASCRIPTS);
    }
    
    public function startContent() {
        $this->block(\Administration\Data\Template\AdministrationTemplate::CONTENT);
    }
    
    public function startMessages() {
        $this->block(\Administration\Data\Template\AdministrationTemplate::MESSAGES);
    }
    
    public function startMenu() {
        $this->block(\Administration\Data\Template\AdministrationTemplate::MENU);
    }
    
    public function setTitle($title) {
        $this->startTitle();
        $this->write($title);
        $this->endBlock();
    }
    
    public function setHeader($headerObject) {
        $this->startPageHeader();
        $this->embedObject($headerObject);
        $this->endBlock();
    }
    
    public function setMenu($menuObject) {
        $this->startMenu();
        $this->embedObject($menuObject);
        $this->endBlock();
    }
    
    public function setContent($contentObject) {
        $this->startContent();
        $this->embedObject($contentObject);
        $this->endBlock();
    }
    
    public function setResult($result) {
        $this->startMessages();
        $this->embedObject($result);
        $this->endBlock();
    }
    
    public function setJavascripts($javascripts) {
        if(count($javascripts)> 0) {
            $this->startJavascripts();
            /* @var $javascript Javascript */
            foreach($javascripts as $javascript) {
                $this->embedObject($javascript);
            }        
            $this->endBlock();
        }
    }
    
    public function setCsss($csss) {
        if(count($csss)> 0) {
            $this->startStylesheets();
            /* @var $css \Administration\Data\Template\Css */
            foreach($csss as $css) {
                $this->embedObject($css);
            }        
            $this->endBlock();
        }
    }
}
