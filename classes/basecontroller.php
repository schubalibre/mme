<?php
/* 
 * Project: ODDS & ENDS
 * File: /classes/basecontroller.php
 * Purpose: abstract class from which controllers extend
 * Author: Robert Dziuba & Inga Schwarze
 */

abstract class BaseController {
    
    protected $urlValues;
    protected $action;
    protected $model;
    protected $view;
    protected $request;
    protected $url;
    
    public function __construct($action, $urlValues) {
        $this->action = $action;
        $this->urlValues = $urlValues;

        require_once('request.php');
        $this->request = new Request(__DIR__);
                
        //establish the view object
        $this->view = new View(get_class($this), str_replace("Action", "",$action));

        //url redirection class
        require_once('url.php');
        $this->url = new Url('http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/{$_SERVER['REQUEST_URI']}");

    }
        
    //executes the requested method
    public function executeAction() {
        return $this->{$this->action}();
    }
}

?>
