<?php
/* 
 * Project: ODDS & ENDS
 * File: /controllers/home.php
 * Purpose: controller for the home of the app.
 * Author: Robert Dziuba & Inga Schwarze
 */

class HomeController extends BaseController
{
    //add to the parent constructor
    public function __construct($action, $urlValues) {
        parent::__construct($action, $urlValues);
        
        //create the model object
        require("models/home.php");
        $this->model = new HomeModel();
    }
    
    //default method
    protected function indexAction()
    {
        $this->view->output($this->model->index());
    }
}

?>
