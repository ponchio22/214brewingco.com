<?php

namespace Ima\Routing;

use Ima\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Yaml\Yaml;

/**
 * Handles all the routing for the current url
 * @author LuisAlfonso
 */
class Routing {
    
    private static $parameters = array();
    
    private static $controller = NULL;
    
    private static $routeName = '';
    
    private static $cached = false;
    
    const PREVIOUS_URL_TAG = 'url';
    
    /**
     * Constructor of the Routing object, once created it automatically calls the
     * parse url method
     */
    public function __construct() {
        $this->parseUrl();
    }
    
    /**
     * Parse the url and get the parts to define which Controller will display the data
     * Calls the method showRoute if a controller is found, if not shows a 404 page
     */
    private function parseUrl() {        
        if(\Ima\Routing\Routing::loadDataFromUrl()) {
            $this->showRoute(\Ima\Routing\Routing::$controller,\Ima\Routing\Routing::$parameters);
        } else {
            $response = \Ima\Routing\Routing::getPageNotFoundResponse();
            $response->send();
        }
    }    
    public static function getPageNotFoundResponse() {
        return new Response("Page not found", '404');        
    }
    /**
     * Calls the controller action based on the given controller
     * @param Controller $controller Controller object 
     * @param array $parameters Array with all the parameters
     * @example /example/{parameter} 
     */
    private function showRoute($controller,$parameters=array()) {   
        $parts = split(':', $controller);            
        $action = $parts[count($parts)-1];
        unset($parts[count($parts)-1]);
        $type = join('\\', $parts);
        /* @var $controller Controller */
        $controller = new $type;
        $controller->executeAction($action,$parameters);
    }    
    /**
     * Reads the configuration files and loads the controller to use, parameters
     * and route name from the url
     * @return boolean
     */
    private static function loadDataFromUrl($forceLoad=false) {        
        if(!\Ima\Routing\Routing::$cached || $forceLoad) {
            $found = false;
            $outputyaml = \Ima\Routing\Routing::loadConfiguration(); 
            \Ima\Routing\Routing::$parameters = array();
            foreach($outputyaml as $key=>$value) {
                $route = $value['path'];
                $routePath = parse_url($route)['path'];
                $currentPath = parse_url(\Ima\Routing\Routing::getCurrentPath())['path'];
                $controller = $value['defaults']['_controller'];            
                $pattern = '([\{\}a-zA-Z0-9]{1,})';
                preg_match_all($pattern, $routePath, $defined);
                preg_match_all($pattern, $currentPath,$original);
                if(count($defined[0]) == count($original[0])) {                    
                    $iFound = true;
                    foreach($original[0] as $okey=>$ovalue) {
                        if($iFound && preg_match('(\{[a-zA-Z0-9]{1,}\})', $defined[0][$okey])) {                            
                            \Ima\Routing\Routing::$parameters[str_replace(array('{','}'), array('',''), $defined[0][$okey])] = $original[0][$okey];                        
                        } else if($iFound && $defined[0][$okey] != $original[0][$okey]){
                            $iFound = false;                        
                        } else if($iFound && $defined[0][$okey] == $original[0][$okey]){                        
                        }            
                    }                
                    if($iFound) {                    
                        $found = true;                            
                        \Ima\Routing\Routing::$controller = $controller;
                        \Ima\Routing\Routing::$routeName = $key;
                    }
                }
            }
            \Ima\Routing\Routing::$cached = true;
            return $found;
        } else {
            return true;
        }
    }    
    /**
     * Loads the configuration files from the bundles
     * @return array Array with all the routing configuration
     */
    public static function loadConfiguration() {
        $default_config_file = 'configuration/routing.yml';
        $bundlesFolder = 'bundles/';
        $output = array();
        $yaml = new Yaml();
        if(file_exists($default_config_file)) {        
            $yamlout = $yaml->parse('configuration/routing.yml');
            $output = ($yamlout != NULL)? $yamlout:array();
        }        
        if(file_exists($bundlesFolder) && is_dir($bundlesFolder)) {
            $bundles = scandir($bundlesFolder);                        
            foreach($bundles as $bundle) {
                if($bundle != '.' && $bundle!='..' && is_dir($bundlesFolder.$bundle)) {
                    if(file_exists($bundlesFolder.$bundle.'/'.$default_config_file)) {
                        $output = array_merge($output, $yaml->parse($bundlesFolder.$bundle.'/'.$default_config_file));
                    }
                }
            }
        }
        return $output;
    }    
    /**
     * Gets the root of the page
     * @return type
     */
    public static function getRoot($isRelative=false) {
        if(!$isRelative) {
            return (isset($GLOBALS['root']))? $GLOBALS['root']:'';
        } else {
            $redirectBase = (isset($_SERVER['REDIRECT_BASE']))? $_SERVER['REDIRECT_BASE']:  dirname($_SERVER['SCRIPT_NAME']);
            $redirectBase = ($redirectBase=='\\' || $redirectBase == '/')? '':$redirectBase;        
            return $redirectBase;            
        }
    }    
    /**
     * Gets the requested path, if parameters are given the keys will be replaced
     * with the values
     * @param string $pathId Id for the path, defined in the routing.yml file
     * @param array $parameters Parameters to be replaced
     * @return string Url for the given path id
     */
    public static function getPath($pathId,array $parameters=array(),$getParameters=array()) {        
        $yaml = \Ima\Routing\Routing::loadConfiguration();
        if(array_key_exists($pathId, $yaml)) {
            $path = $yaml[$pathId]['path'];
            if(count($parameters)>0) {
                foreach($parameters as $key=>$parameter) {
                    $path = str_replace('{'.$key.'}',$parameter, $path);
                }
            }
            if(count($getParameters)>0) {
                $query = http_build_query($getParameters);
                return \Ima\Routing\Routing::getRoot(true) . $path . '?' . $query;
            }
            return \Ima\Routing\Routing::getRoot(true) . $path;
        }
        return '';
    }    
    /**
     * Get the parameters loaded from the url
     * @return type
     */
    public static function getParameters() {
        \Ima\Routing\Routing::loadDataFromUrl();
        return \Ima\Routing\Routing::$parameters;
    }    
    /**
     * Get the controller loaded from the url
     * @return type
     */
    public static function getController() {
        \Ima\Routing\Routing::loadDataFromUrl();
        return \Ima\Routing\Routing::$controller;
    }    
    /**
     * Get the route name that matches the url
     * @return type
     */
    public static function getRouteName() {
        \Ima\Routing\Routing::loadDataFromUrl();
        return \Ima\Routing\Routing::$routeName;
    }    
    /**
     * Gets the current path after the root of the project
     * @return type
     */
    public static function getCurrentPath($attachGetUrl=true) {        
        $redirectBase = \Ima\Routing\Routing::getRoot(true);
        $filename = '/' . basename($_SERVER['SCRIPT_NAME']);
        $redirectUri = $_SERVER['REQUEST_URI'];        
        $realbase = str_replace($filename,'',$redirectUri);    
        $path = str_replace($redirectBase,'',$realbase);        
        $patharr = parse_url($path);
        if(!$attachGetUrl && key_exists('query', $patharr)) {
            $path = str_replace("?".$patharr['query'], '', $path);
        }
        return $path;
    }
    
    public static function getRoutingPath() {
        
    }
    
    /**
     * Get the complete current path from the root of the project
     * @return type
     */
    public static function getFullCurrentPath() {
        $fullPath = \Ima\Routing\Routing::getRoot(true) . \Ima\Routing\Routing::getCurrentPath();
        $fullPath = (substr($fullPath,  strlen($fullPath)-1,1)=='/')? substr($fullPath,0,strlen($fullPath)-1):$fullPath;
        return $fullPath;
    }
    
    /**
     * Encode the current url into an array so it can be send as a query parameter
     * @param array $queryArray Array to attach the current url to, creates new if empty
     * @return type
     */
    public static function attachCurrentUrl(array $queryArray = array()) {
        $queryArray = array_merge($queryArray,array(\Ima\Routing\Routing::PREVIOUS_URL_TAG=>urlencode($_SERVER['REQUEST_URI'])));
        return $queryArray;
    }
    
    /**
     * Gets the encoded url from the query request
     * @return type
     */
    public static function getPreviousUrl() {
        $request = Request::createFromGlobals();
        $url = $request->query->get(\Ima\Routing\Routing::PREVIOUS_URL_TAG);
        return ($url!=NULL)? urldecode($request->query->get('url')):NULL;
    }
    
    public static function hasPreviousUrl() {
        return (\Ima\Routing\Routing::getPreviousUrl()!=NULL);
    }
    
    public static function getCurrentRouteName() {
        return Routing::$routeName;
    }
    
}