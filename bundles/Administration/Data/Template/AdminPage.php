<?php

namespace Administration\Data\Template;

use Administration\Data\Template\AdminWebPageFormResult;
use Administration\Data\Template\AdminWebPageHeader;
use Ima\UI\Form;
use Ima\UI\Javascript;

/**
 * Representation of a page using the Administration Template
 * @author lpena
 */
class AdminPage {
    /**
     *
     * @var Form
     */
    public $content;
    
    /**
     * Menu of the web page
     * @var \Administration\Data\Template\SimpleMenu
     */
    public $menu;
    
    /**
     * Header of the web page
     * @var AdminWebPageHeader
     */
    public $header;
    /**
     *
     * @var string
     */
    public $title;
    /**
     *
     * @var \Administration\Data\Template\AdministrationTemplate
     */
    protected $template;
    /**
     *
     * @var AdminWebPageFormResult
     */
    public $result;
    /**
     *
     * @var array 
     */
    public $javascripts = array();
    
    public $css = array();
    /**
     * Constructor, initialize the template object
     */
    public function __construct() {        
        $this->template = new \Administration\Data\Template\AdministrationTemplate();
        $this->header = new AdminWebPageHeader();
        $this->menu = new \Administration\Data\Template\SimpleMenu();        
    }
    
    /**
     * Builds and send the objects that represents the html code
     */
    public function send() {        
        $jss = $this->javascripts; 
        if($this->content != NULL) {
            $cjss = $this->content->getJavascripts();
            foreach($cjss as $js){
                $jss[] = $js;
            }
            $csss = $this->css;
            $ccss = $this->content->getStylesheets();
            foreach($ccss as $css){
                $csss[] = $css;
            }
        }
        $this->template->setTitle($this->title);
        $this->template->setHeader($this->header);
        if(isset($this->result)) $this->template->setResult($this->result);
        $this->template->setMenu($this->menu);
        $this->template->setContent($this->content);    
        $this->template->setJavascripts($jss);
        $this->template->setCsss($csss);
        $this->template->send();
    }    
    /**
     * Sets the success/error message to the page
     * @param type $success
     * @param type $message
     * @return \Administration\Data\Template\AdminPage
     */
    public function setSuccess($success,$message='') {
        $this->result = new AdminWebPageFormResult($success, array($message));
        return $this;
    }
    /**
     * Add a javascript file to the page
     * @param Javascript $javascript
     */
    public function addJavascript(Javascript $javascript) {
        array_push($this->javascripts,$javascript);
    }
    /**
     * 
     * @param \Administration\Data\Template\Css $css
     */
    public function addCss(\Administration\Data\Template\Css $css) {
        array_push($this->css, $css);
    }
}
