<?php

/*
 * Project: ODDS & ENDS
 * File: /models/furniture.php
 * Purpose: model for the furniture controller.
 * Author: Robert Dziuba & Inga Schwarze
 */
class FurnitureModel extends BaseModel
{
    //data passed to the home index view
    public function index()
    {
        $this->viewModel->set("pageTitle","Furniture - ODDS&amp;ENDS");
        return $this->viewModel;
    }
}
