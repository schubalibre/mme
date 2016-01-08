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
    public function __construct($action, $urlValues)
    {
        parent::__construct($action, $urlValues);

        //create the model object
        require("models/home.php");
        $this->model = new HomeModel();

        require("helpers/formValidator.php");
    }

    //default method
    protected function indexAction()
    {
        if($this->request->xmlhttprequest()){
            $this->view->ajaxRespon($this->model->index());
        }else{
            $this->view->output($this->model->index());
        }
    }

    public function roomAction() {
        if($this->request->httpMethod() === "GET") {

            $validations = array(
                'id' => 'number'
            );

            $required = array('id');

            $validator = new FormValidator($validations, $required);

            if ($validator->validate($this->request->uriValues())) {
                $data = $validator->sanatize($this->request->uriValues());

                $this->view->ajaxRespon($this->model->getRoom($data->id));

            }
        }
    }

    public function articleAction() {
        if($this->request->httpMethod() === "GET") {

            $validations = array(
                'id' => 'number'
            );

            $required = array('id');

            $validator = new FormValidator($validations, $required);

            if ($validator->validate($this->request->uriValues())) {
                $data = $validator->sanatize($this->request->uriValues());

                $this->view->ajaxRespon($this->model->getArticle($data->id));
            }
        }
    }

    public function contactAction(){
        if($this->request->xmlhttprequest()){
            $this->view->ajaxRespon($this->model->staticPage("Kontact"));
        }else{
            $this->view->output($this->model->staticPage("Kontact"));
        }
    }

    public function impressumAction(){
        if($this->request->xmlhttprequest()){
            $this->view->ajaxRespon($this->model->staticPage("Impressum"));
        }else{
            $this->view->output($this->model->staticPage("Impressum"));
        }
    }

    public function termsConditionsAction(){
        if($this->request->xmlhttprequest()){
            $this->view->ajaxRespon($this->model->staticPage("AGB"));
        }else{
            $this->view->output($this->model->staticPage("AGB"));
        }
    }

}

?>
