<?php

namespace Administration\Data\Template;

use Ima\UI\HtmlRepresentation;
use Ima\UI\Javascript;
/**
 * Description of SimpleResult
 *
 * @author LuisAlfonso
 */
class AdminWebPageFormResult extends HtmlRepresentation {
    
    private $success;
    
    private $messages = array();
    
    private $alertClass = "";
    
    public function __construct($success='true',array $messages = array()) {
        parent::__construct("bundles/Administration/views/Ajax/AdminWebPageFormResult.php");
        $this->addJavascript(new Javascript("resources/Administration/js/AdminWebPageFormResult.js"));
        $this->success = $success;
        $this->messages = $messages;
        $this->setVisible(false);
    }
    
    public function getSuccess() {
        return $this->success;
    }
    
    public function setSuccess($success) {
        $this->setVisible(true);
        $this->success = $success;    
        $this->alertClass = ($success)? "alert-success":"alert-danger";
        return $this;
    }
    
    public function setProcessing($processing) {
        $this->setVisible(true);
        $this->alertClass = "alert-info";
        return $this;
    }
    
    public function addMessage($message) {
        $this->setVisible(true);
        $this->messages[] = $message;
        return $this;
    }
    
    public function setMessages(array $messages) {
        $this->setVisible(true);
        $this->messages = $messages;
        return $this;
    }
        
    public function getMessages() {
        return $this->messages;
    }
    
    public function getAlertClass() {
        return $this->alertClass;
    }


}
