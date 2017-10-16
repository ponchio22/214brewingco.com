<?php

namespace Administration\Controls;

use Administration\Data\Template\AdminWebPageFormResult;
use Finanzas\Controls\PagoNuevoForm;
use Finanzas\Controls\PagosListaForm;
use Finanzas\Controls\PedidosListaForm;
use Ima\UI\HtmlRepresentation;
use Ima\UI\Javascript;
use Ima\Users\AuthenticationManagment;
use Ima\Users\User;

/**
 * UserHomePageContent
 * @author lpena
 */
class UserHomePageContent extends HtmlRepresentation {
    
    private $pedidosForm;
    
    private $result;
            
    private $agregarPagoForm;
    
    private $pagosForm;
    
    public function __construct() {
        parent::__construct("bundles/Administration/views/Ajax/UserHomePageContent.php");
        $this->addJavascript(new Javascript("resources/Administration/js/UserHomePageContent.js"));                
        $this->result = (new AdminWebPageFormResult(true))->setVisible(false);
        $this->pedidosForm = new PedidosListaForm();
        $this->agregarPagoForm = (new PagoNuevoForm())->setVisible(false);
        $this->pagosForm = (new PagosListaForm());
        $this->pagosForm->getClienteFilter()->setVisible(false);
        $this->pagosForm->getClienteFilterTagField()->setVisible(false);        
        $this->pagosForm->getPagosTotal()->setVisible(false);  
        $this->pagosForm->getPagosListaFormField()->setNotAdminMode(true);
        $this->addItem($this->result);
        $this->addItem($this->pedidosForm);        
        $this->addItem($this->agregarPagoForm);
        $this->addItem($this->pagosForm);        
    }
    /**
     * 
     * @return PedidosListaForm
     */
    public function getPedidosForm() {
        return $this->pedidosForm;
    }
    /**
     * 
     * @return AdminWebPageFormResult
     */
    public function getResult() {
        return $this->result;
    }
    /**
     * 
     * @return PagoNuevoForm
     */
    public function getAgregarPagoForm() {
        return $this->agregarPagoForm;
    }
    /**
     * 
     * @return PagosListaForm
     */
    public function getPagosForm() {
        $usermysql = AuthenticationManagment::getInstance()->getCurrentSessionUser();
        $user = NULL;
        if($usermysql!=NULL) {
            $user = (new User())->fromMysql($usermysql);
        }
        $this->pagosForm->getPagosListaFormField()->setShowPending(true)->setUser($user)->getPagos();        
        return $this->pagosForm;
    }
}