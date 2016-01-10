<?php
/* 
 * Project: ODDS & ENDS
 * File: /classes/basemodel.php
 * Purpose: abstract class from which models extend.
 * Author: Robert Dziuba & Inga Schwarze
 */

class BaseModel {
    
    protected $viewModel;

    protected $database;

    private $error = [];

    //create the base and utility objects available to all models on model creation
    public function __construct()
    {
        require_once "config.php";

        $this->database = new PDO("mysql:host=".DB_HOST.";dbname=".DB_DB, DB_USER, DB_PASSWORD);
        $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->database->exec('SET NAMES "utf8"');

        $this->viewModel = new ViewModel();

	    $this->commonViewData();
    }

    //establish viewModel data that is required for all views in this method (i.e. the main template)
    protected function commonViewData() {

        $this->viewModel->set("mainMenu",array(
                "backend" => "/backend",
                "kategorien" => "/category",
                "artikel" => "/article",
                "departments" => "/department",
                "räume" => "/room",
                "logout" => "/backend/logout")
        );
        $this->viewModel->set("header", "header.php");
        $this->viewModel->set("footer", "footer.php");
    }

    /**
     * @param $errorKey
     * @param $errorValue
     */
    protected function setError($errorKey,$errorValue){
        $this->error = array_merge_recursive($this->error,array($errorKey => $errorValue));
        $this->viewModel->set("errors",$this->error);
    }

    protected function tableIdAsArrayKey($data)
    {
        $myArray = null;
        foreach ($data as $value) {
            $myArray[$value['id']] = $value;
        }

        return $myArray;
    }

}

?>
