<?php
/*
 * Project: ODDS & ENDS
 * File: /controllers/home.php
 * Purpose: controller for the home of the app.
 * Author: Robert Dziuba & Inga Schwarze
 */

class ClientController extends BaseController
{
    //add to the parent constructor
    public function __construct($action, $urlValues)
    {
        parent::__construct($action, $urlValues);

        //create the model object
        require("models/client.php");
        $this->model = new ClientModel();

        require("helpers/formValidator.php");

        if($_SESSION['HTTP_USER_AGENT'] != sha1($_SERVER['HTTP_USER_AGENT'])) {
            header('Location: ' . $this->url->generate("/backend/login"));
            exit();
        }
    }

    //default method
    protected function indexAction()
    {
        $this->model->getAllClients();
        $this->view->output($this->model->index());
    }

    protected function newAction()
    {
        $error = null;

        if($this->request->httpMethod() === "POST") {

            $validations = array(
                'name' => 'anything',
                'lastname' => 'anything',
                'email' => 'email',
                'password' => 'anything',
                'confirm_password' => 'anything'
            );

            $required = array('name', 'lastname', 'email');

            $validator = new FormValidator($validations, $required);

            if ($validator->validate($this->request->body())) {
                $data = $validator->sanatize($this->request->body());

                $id = $this->model->insertClient($data);

                if ($id !== null) {
                    header('Location: '.$this->url->generate("/client"));
                    exit();
                }
            }else{
                $error = $validator->getErrors();
            }
        }

        $this->view->output($this->model->newModel($error));
    }

    protected function updateAction()
    {
        $error = null;
        $id = $this->request->uriValues()->id;

        if($this->request->httpMethod() === "POST"){

            $validations = array(
                'id' => 'number',
                'name' => 'anything',
                'lastname' => 'anything',
                'email' => 'email',
                'password'=>'anything',
                'confirm_password'=>'anything');

            $required = array('id','name','lastname', 'email');

            $validator = new FormValidator($validations, $required);

            if($validator->validate($this->request->body())) {
                $data = $validator->sanatize($this->request->body());

                $rows = $this->model->updateClient($data);

                if($rows > 0) {
                    header('Location: ' . $this->url->generate("/client"));
                    exit();
                }
            }
        }

        if($id != 0){
            $this->model->getClient($id);
            $this->view->output($this->model->updateModel($error));
            exit();
        }

        // if no id is set
        require("controllers/error.php");
        $controller = new ErrorController("badurl",$this->urlValues);
        $controller->executeAction();
    }

    protected function deleteAction()
    {
        if($this->request->httpMethod() === "GET"){

            $validations = array(
                'id' => 'number');

            $required = array('id');

            $validator = new FormValidator($validations, $required);

            if($validator->validate($this->request->uriValues())) {
                $data = $validator->sanatize($this->request->uriValues());

                $rows = $this->model->deleteClient($data);

                if($rows > 0) {
                    header('Location: ' . $this->url->generate("/client"));
                    exit();
                }
            }
        }

        // if no id is set
        require("controllers/error.php");
        $controller = new ErrorController("badurl",$this->urlValues);
        $controller->executeAction();
    }
}
