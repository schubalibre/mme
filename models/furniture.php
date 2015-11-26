<?php

/**
 * Created by PhpStorm.
 * User: roberto
 * Date: 25.11.15
 * Time: 18:14
 */
class FurnitureModel extends BaseModel
{
    //data passed to the home index view
    public function index()
    {
        $this->viewModel->set("pageTitle","Furniture");
        return $this->viewModel;
    }
}
