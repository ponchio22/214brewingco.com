<?php

namespace Ima\Pages;

use Administration\Data\Template\AdminWebPageFormResult;
use Administration\Data\Template\AdminWebPageHeader;
use Ima\Forms\ProjectDataConfigForm;
use Ima\UI\WebPage;
use Ima\UI\WebPageContainer;
use Ima\UI\Well;

/**
 * ProjectDataPage
 * @author lpena
 */
class ProjectDataPage extends WebPage {
    
    private $projectDataConfigForm;
    
    private $pageAlert;
    
    private $wellMessage = "<span class='glyphicon glyphicon-warning-sign'></span> There was no configuration found for the current project, please fill the required information to proceed.";
    
    public function __construct() {
        parent::__construct();
        $this->setTitle("Project Data Configuration");
        $container = new WebPageContainer();
        $this->projectDataConfigForm = new ProjectDataConfigForm("projectDataConfig");
        $this->result = new AdminWebPageFormResult();
        $this->pageAlert = new Well("projectDataWell",$this->wellMessage);
        $container->addItem(new AdminWebPageHeader("Project", "Configuration"))
                ->addItem($this->result)
                ->addItem($this->pageAlert)
                ->addItem($this->projectDataConfigForm);
        $this->addItem($container);
    }
    /**
     * 
     * @return ProjectDataConfigForm
     */
    public function getProjectDataConfigForm() {
        return $this->projectDataConfigForm;
    }
    /**
     * 
     * @return Well
     */
    public function getPageAlert() {
        return $this->pageAlert;
    }




}
