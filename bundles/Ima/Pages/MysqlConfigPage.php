<?php

namespace Ima\Pages;

use Administration\Data\Template\AdminWebPageFormResult;
use Administration\Data\Template\AdminWebPageHeader;
use Ima\Forms\MysqlConfigForm;
use Ima\UI\WebPage;
use Ima\UI\WebPageContainer;
use Ima\UI\Well;

/**
 * MysqlConfigPage
 * @author lpena
 */
class MysqlConfigPage extends WebPage {
    
    private $mysqlConfigForm;
    
    private $pageAlert;
    
    private $result;
    
    public function __construct() {
        parent::__construct();
        $this->setTitle("Configuración de información de Mysql");
        $container = new WebPageContainer();
        $this->mysqlConfigForm = new MysqlConfigForm("mysqlConfig");
        $this->result = new AdminWebPageFormResult();
        $this->pageAlert = new Well("mysqlConfigPageWell","<span class='glyphicon glyphicon-warning-sign'></span> You were redirected to this page because there was no configuration found for the mysql connection, please fill the required information to proceed.");
        $container->addItem(new AdminWebPageHeader("Database", "Configuration"))
                ->addItem($this->result)
                ->addItem($this->pageAlert)
                ->addItem($this->mysqlConfigForm);
        $this->addItem($container);
    }
    /**
     * Gets the mysql config form the page is using
     * @return MysqlConfigForm
     */
    public function getMysqlConfigForm() {
        return $this->mysqlConfigForm;
    }
    /**
     * 
     * @return AdminWebPageFormResult
     */
    public function getResult(){
        return $this->result;
    }
    /**
     * 
     * @return Well
     */
    public function getPageAlert() {
        return $this->pageAlert;
    }




}
