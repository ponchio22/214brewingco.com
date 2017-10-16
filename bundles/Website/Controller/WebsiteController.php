<?php

namespace Website\Controller;

use Ima\Controller\Controller;
use Website\Pages\HomePage;

/**
 * HomeController
 * @author LuisAlfonso
 */
class WebsiteController extends Controller {
    
    public function home() {
        return $this->renderHtmlObject(new HomePage());
    }
}
