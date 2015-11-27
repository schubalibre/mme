<?php
/* 
 * Project: ODDS & ENDS
 * File: /models/home.php
 * Purpose: model for the home controller.
 * Author: Robert Dziuba
 */

class HomeModel extends BaseModel
{
    //data passed to the home index view
    public function index()
    {   
        $this->viewModel->set("pageTitle","Home - ODDS&amp;ENDS");
        return $this->viewModel;
    }
}

?>
