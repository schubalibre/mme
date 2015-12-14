<?php
/* 
 * Project: ODDS & ENDS
 * File: /classes/basemodel.php
 * Purpose: abstract class from which models extend.
 * Author: Robert Dziuba
 */

class BaseModel {
    
    protected $viewModel;

    protected $database;

    //create the base and utility objects available to all models on model creation
    public function __construct()
    {
        $this->database = new PDO("mysql:host=localhost;dbname=mme", "root", "");
        $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->database->exec('SET NAMES "utf8"');

        $this->viewModel = new ViewModel();

	    $this->commonViewData();
    }

    //establish viewModel data that is required for all views in this method (i.e. the main template)
    protected function commonViewData() {

        $this->viewModel->set("header", "header.php");
        $this->viewModel->set("footer", "footer.php");

        //e.g. $this->viewModel->set("mainMenu",array("Home" => "/home", "Help" => "/help"));
    }
}

?>
