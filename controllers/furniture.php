<?php
/**
 * Created by PhpStorm.
 * User: roberto
 * Date: 25.11.15
 * Time: 18:13
 */

class FurnitureController extends BaseController
{
    //add to the parent constructor
    public function __construct($action, $urlValues)
    {
        parent::__construct($action, $urlValues);
        //create the model object
        require("models/furniture.php");
        $this->model = new FurnitureModel();
    }

    //default method
    protected function index()
    {
        $this->view->output($this->model->index());
    }
}