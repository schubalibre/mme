<?php
/*
 * Project: ODDS & ENDS
 * File: /controllers/home.php
 * Purpose: controller for the home of the app.
 * Author: Robert Dziuba
 */

class ClientController extends BaseController
{
    //add to the parent constructor
    public function __construct($action, $urlValues)
    {
        parent::__construct($action, $urlValues);

        //create the model object
        require("models/client.php");
        require("classes/FormValidator.php");
        $this->model = new ClientModel();
    }

    //default method
    protected function index()
    {
        $this->view->output($this->model->index());
    }

    protected function newClient()
    {
        if($this->request->httpMethod() === "POST"){

            $id = $this->model->creatNewClient($this->request->body());

            if($id !== null) {
                header('Location: ' . $this->url->generate("/client"));
                exit();
            }
        }

        $this->view = new View(get_class($this), "clientForm");

        $this->view->output($this->model->newClient());
    }

    protected function update()
    {

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


        if($this->request->uriValues()->id != 0){
            $this->view = new View(get_class($this), "clientForm");
            $this->view->output($this->model->getClient($this->request->uriValues()));
            exit();
        }

        // if no id is set
        require("controllers/error.php");
        $controller = new ErrorController("badurl",$this->urlValues);
        $controller->executeAction();
    }

    protected function delete()
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
