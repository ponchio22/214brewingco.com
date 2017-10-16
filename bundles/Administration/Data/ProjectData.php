<?php

namespace Administration\Data;

use Exception;
use Ima\Controller\ImaController;
use Ima\Routing\Routing;
use Symfony\Component\Yaml\Yaml;


/**
 * ProjectData
 * @author lpena
 */
class ProjectData {
    
    private $companyName = "";
    
    private $encryptCode = "";
    
    private $email = "";
    
    private $emailServer = "";
    
    private $emailPassword = "";
    
    private $cacheJs = true;
    
    private $cacheCss = true;
    
    private $type;    
    
    private $redirect = true;
    
    public function __construct($redirect=true) { 
        $this->redirect = $redirect;
        $this->type = \Administration\Data\ProjectType::BASIC;
        $this->loadParameters();        
    }
    
    public function loadParameters() {
        $yaml = new Yaml();        
        try {
            $filename = $this->getConfigFilename();            
            if(file_exists($filename)) {
            $outputyaml = $yaml->parse(file_get_contents($filename));            
            $this->companyName = @$outputyaml['information']['company'];
            $this->encryptCode = @$outputyaml['information']['encryptCode'];
            $this->email = @$outputyaml['information']['email'];
            $this->emailServer = @$outputyaml['information']['emailServer'];
            $this->emailPassword = @$outputyaml['information']['emailPassword'];
            $this->type = @$outputyaml['information']['type'];
            $this->cacheJs = isset($outputyaml['cache']['js']) ? $outputyaml['cache']['js'] : true;
            $this->cacheCss = isset($outputyaml['cache']['css']) ? $outputyaml['cache']['css'] : true; 
            } else {
                throw new Exception('File Not Found');
            }
        } catch(Exception $e) {
            if($this->redirect) {
                $newURL = Routing::getPath(ImaController::PROJECT_DATA_CONFIGURATION,[],  Routing::attachCurrentUrl());
                header('Location: '. $newURL);
                die();
            }
        }
    }
    
    /**
     * Gets the configuration filename
     * @return type
     */
    public function getConfigFilename() {
        return Routing::getRoot() . 'configuration/projectdata.yml'; 
    }
    
    public function getCompanyName() {
        return $this->companyName;
    }
    
    public function getEncryptCode() {
        return $this->encryptCode;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getEmailServer() {
        return $this->emailServer;
    }

    public function getEmailPassword() {
        return $this->emailPassword;
    }
    /**
     * 
     * @return type
     */
    public function getCacheJs() {
        return $this->cacheJs;
    }
    /**
     * 
     * @return type
     */
    public function getCacheCss() {
        return $this->cacheCss;
    }
    /**
     * 
     * @return type
     */
    public function getType() {
        return $this->type;
    }

}
