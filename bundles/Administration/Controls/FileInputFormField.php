<?php

namespace Administration\Controls;

use Administration\Controller\AdministrationController;
use Ima\Routing\Routing;
use Ima\UI\FormField;
use Ima\UI\FormFieldInterface;
use Ima\UI\Javascript;
use Ima\UI\Stylesheet;

/**
 * FileInputFormField
 * @author lpena
 */
class FileInputFormField extends FormField implements FormFieldInterface {
    
    private $uploadsDirectory = "";
    
    
    private $ajaxUploadPath = "";
    
    private $hasValueLabel = "Ver Archivo";
    
    private $autoUpload = true;
    
    public function __construct($id, $name, $label,$ajaxUploadRoute=AdministrationController::UPLOAD_FILE_ROUTE,$uploadsFolder="/uploadedfiles/files/") {
        parent::__construct($id, $name, $label);        
        $this->uploadsDirectory = $uploadsFolder;
        $this->ajaxUploadPath = Routing::getPath($ajaxUploadRoute);
        $this->htmlFile = "bundles/Administration/views/Ajax/FileInputFormField.php";        
        $this->addJavascript(new Javascript("resources/Administration/js/FileInputFormField.js"));
        $this->addStylesheet(new Stylesheet("resources/Administration/css/FileInputFormField.css"));        
    }
    
    public function setValue($value) {        
        return parent::setValue($value);        
    }
    
    public function getValue() {
        return parent::getValue();
    }
    
    public function getUploadsDirectory() {
        return $this->uploadsDirectory;
    }
    
    public function getAjaxUploadPath() {
        return $this->ajaxUploadPath;
    }
    
    public function getHasValueLabel() {
        return $this->hasValueLabel;
    }

    public function setHasValueLabel($hasValueLabel) {
        $this->hasValueLabel = $hasValueLabel;
        return $this;
    }

    public function getAutoUpload() {
        return $this->autoUpload;
    }

    public function setAutoUpload($autoUpload) {
        $this->autoUpload = $autoUpload;
        return $this;
    }




}
