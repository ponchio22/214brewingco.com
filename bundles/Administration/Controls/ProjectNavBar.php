<?php

namespace Administration\Controls;

use Administration\Controller\AdministrationController;
use Administration\Data\ProjectData;
use Ima\Routing\Routing;
use Ima\UI\NavBar;
use Ima\UI\NavBarBrand;
use Ima\UI\NavBarPosition;
use Ima\UI\Stylesheet;

/**
 * ProjectNavBar
 * @author lpena
 */
class ProjectNavBar extends NavBar {
    
    public function __construct($id="projectNavBar") {
        parent::__construct($id);        
        $this   ->addStylesheet(new Stylesheet("resources/Administration/css/ProjectNavBar.css"))
                ->setPosition(NavBarPosition::FIXED_TOP)
                ->setBrand((new NavBarBrand("", "resources/Administration/images/cervezadminwhnavbar.png",Routing::getPath(AdministrationController::HOME_PAGE_ROUTE)))->addCssClass("company_brand"));
        
    }
}
