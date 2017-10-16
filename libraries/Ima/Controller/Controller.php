<?php

namespace Ima\Controller;

use Administration\Data\Template\AdminPage;
use Ima\Routing\Routing;
use Ima\UI\HtmlRepresentation;
use ReflectionMethod;
use ReflectionParameter;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Description of Controller
 *
 * @author lpena
 */
class Controller {
    
    public function executeAction($action,$parameters) {
        $actionOut = $action . "Action";
        if(!method_exists($this, $action . "Action")) {
            $actionOut = $action;
        }
        if(method_exists($this, $actionOut)) {
            $refl = new ReflectionMethod($this, $actionOut);        
            $methodParameters = $refl->getParameters();
            $isRequest;
            if(count($methodParameters)>0) {
                if(count($methodParameters)==1) {
                    /* @var $methodParameter ReflectionParameter */
                    $methodParameter = $methodParameters[0];
                    if($methodParameter->isArray()) {
                        $response = $this->$actionOut($parameters);
                    } else{                    
                        $request = Request::createFromGlobals();
                        $response = $this->$actionOut($request);
                    }
                } else if(count($methodParameters)==2) {
                    $request = Request::createFromGlobals();
                    $response = $this->$actionOut($request,$parameters);
                } else {
                    $response = $this->$actionOut();
                }
            } else {
                $response = $this->$actionOut();
            }
            if(is_object($response)) {
                $response->send();
            }
        } else {
            $response = new Response("The method $actionOut doesnt exist in the object ". get_class($this));
            $response->send();
        }
    }
    
    public function render($file,array $vars = array()) {        
        if (is_array($vars) && !empty($vars)) {
            $vars = $this->encodeArray($vars);
            extract($vars);
        }
        ob_start();
        include $file;
        return new Response(ob_get_clean());
    }
    /**
     * 
     * @param AdminPage $object
     * @return Response
     */
    public function renderObject(AdminPage $object) {        
        ob_start();
        $object->send();
        return new Response(ob_get_clean());
    }
    
    public function renderHtmlObject(HtmlRepresentation $object) {
        ob_start();
        $object->output();
        //return new Response(ob_get_clean());
    }
    
    public function renderview($file,array $vars=array()) {
        if (is_array($vars) && !empty($vars)) {
            $vars = $this->encodeArray($vars);
            extract($vars);
        }
        ob_start();
        include $file;        
        return ob_get_clean();
    }
    
    /**
     * Returns a RedirectResponse to the given URL.
     *
     * @param string  $url    The URL to redirect to
     * @param int     $status The status code to use for the Response
     *
     * @return RedirectResponse
     */
    public function redirect($url, $status = 302)
    {
        return new RedirectResponse($url, $status);
    }
    
    public function redirectToRoute($routeName,$preserveQuery=true,$parameters=array()) {
        $request = Request::createFromGlobals();
        $parameters = (count($parameters)==0)? Routing::getParameters():$parameters;
        $path = Routing::getPath($routeName,$parameters,($preserveQuery)?$request->query->all():array());
        return $this->redirect($path);
    }
    
    private function encodeArray(array $arr) { 
        $newArray = array();
        foreach($arr as $key=>$val) {
            if(is_array($val)) {
                $newArray[$key] = $this->encodeArray($val);
            } else if(is_object ($val)) {
                $newArray[$key] = $val;
            } else {
                $newArray[$key] = utf8_encode($val);
            }
        }
        return $newArray;
    }
    /**
     * Checks if current request was with Ajax
     * @return type
     */
    protected function isAjax() {
        $request = Request::createFromGlobals();        
        return ($request->headers->get("x-requested-with") != NULL && $request->headers->get("x-requested-with") == "XMLHttpRequest");
    }
}
