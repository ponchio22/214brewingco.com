<?php

namespace Administration\Data;

use Ima\Routing\Routing;
use Symfony\Component\HttpFoundation\Request;

class NavigationHelper {
    
    public static function getMenuActive($pathId) {
        $paths = (!is_array($pathId))? array($pathId):$pathId;
        $active = '';
        foreach($paths as $path) {
            if(Routing::getFullCurrentPath() == Routing::getPath($path)) {
                $active = 'active';
            }
        }
        return $active;
    }
    
    public static function getPreviousUrl() {
        return Routing::getPreviousUrl();
    }
    
}