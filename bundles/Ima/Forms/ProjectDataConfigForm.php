<?php

namespace Ima\Forms;

use Administration\Controls\RegresarButton;
use Administration\Data\ProjectType;
use Administration\Data\Template\EmptyForm;
use Administration\Data\Template\FormButton;
use Administration\Data\Template\SimpleFormCheckBoxField;
use Administration\Data\Template\SimpleFormInputTextField;
use Administration\Data\Template\SimpleFormSelectField;
use Administration\Data\Template\SimpleFormSelectFieldOption;

/**
 * ProjectDataConfigForm
 * @author lpena
 */
class ProjectDataConfigForm extends EmptyForm {
    
    private $companyName;
    private $encryptionCode;
    private $email;
    private $emailServer;
    private $emailPassword;
    private $guardarButton;
    private $regresarButton;
    private $cacheCss;
    private $cacheJs;
    private $type;
    
    public function __construct($name) {
        parent::__construct($name);
        $this->companyName = new SimpleFormInputTextField("company", "company", "Company Name","","Enter the company name for the project");
        $this->encryptionCode = new SimpleFormInputTextField("encryptionCode", "encryptionCode", "Encryption Code","","Enter the encryption code");
        $this->email = new SimpleFormInputTextField("email", "email", "Email","","Enter the email you want the system to use to send emails");
        $this->emailServer = new SimpleFormInputTextField("emailServer", "emailServer", "Email Server","","Enter the email server");
        $this->emailPassword = new SimpleFormInputTextField("emailPassword", "emailPassword", "Email Password","","Enter the email password");
        $this->cacheJs = new SimpleFormCheckBoxField("cacheJs", "cacheJs", "Cache Js");
        $this->cacheCss = new SimpleFormCheckBoxField("cacheCss", "cacheCss", "Cache Css");
        $this->type = new SimpleFormSelectField("projecttype", "projecttype", "Type", ProjectType::BASIC, [new SimpleFormSelectFieldOption(ProjectType::BASIC, "Basic"),new SimpleFormSelectFieldOption(ProjectType::ADVANCED, "Advanced"),new SimpleFormSelectFieldOption(ProjectType::BREWERY, "Brewery")]);
        $this->guardarButton = (new FormButton("guardar", "guardar","<span class='glyphicon glyphicon-floppy-disk'></span> Save"))->setPrimary(true);
        $this->regresarButton = new RegresarButton("regresar", "regresar");
        $this->addItem($this->companyName)
                ->addItem($this->encryptionCode)
                ->addItem($this->email)
                ->addItem($this->emailServer)
                ->addItem($this->emailPassword)
                ->addItem($this->type)
                ->addItem($this->cacheJs)
                ->addItem($this->cacheCss)
                ->addItem($this->guardarButton)
                ->addItem($this->regresarButton);
    }
    /**
     * 
     * @return SimpleFormInputTextField
     */
    public function getCompanyName() {
        return $this->companyName;
    }
    /**
     * 
     * @return FormButton
     */
    public function getGuardarButton() {
        return $this->guardarButton;
    }
    /**
     * 
     * @return SimpleFormInputTextField
     */
    public function getEncryptionCode() {
        return $this->encryptionCode;
    }
    /**
     * 
     * @return SimpleFormInputTextField
     */
    public function getEmail() {
        return $this->email;
    }
    /**
     * 
     * @return SimpleFormInputTextField
     */
    public function getEmailServer() {
        return $this->emailServer;
    }
    /**
     * 
     * @return SimpleFormInputTextField
     */
    public function getEmailPassword() {
        return $this->emailPassword;
    }
    /**
     * 
     * @return SimpleFormCheckBoxField
     */
    public function getCacheCss() {
        return $this->cacheCss;
    }
    /**
     * 
     * @return SimpleFormCheckBoxField
     */
    public function getCacheJs() {
        return $this->cacheJs;
    }
    /**
     * 
     * @return SimpleFormSelectField
     */
    public function getType() {
        return $this->type;
    }
}
