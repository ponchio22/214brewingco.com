<?php

namespace Administration\Controls;

use Authentication\Controller\Authentication;
use Ima\UI\NavBarItem;
use Ima\UI\NavBarPosition;

/**
 * UserNavBar
 * @author lpena
 */
class UserNavBar extends \Administration\Controls\ProjectNavBar {
    
    public function __construct() {
        parent::__construct("user_navbar");
        $cerrarSesion = (new NavBarItem("Cerrar Sesión", Authentication::getRedirectToLogoutPath()))->setIconClass("glyphicon glyphicon-off")->setAlignRight(true);
        $nuevoPago = (new NavBarItem("<span class='fa fa-dollar'></span> Nuevo Pago"))->addCssClass("nuevoPagoBtn");
        $this->addItem($nuevoPago);
        $this->addItem($cerrarSesion);
    }
    
}
