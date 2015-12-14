<?php
/*
 * Project: ODDS & ENDS
 * File: /controllers/home.php
 * Purpose: controller for the home of the app.
 * Author: Robert Dziuba
 */

class CategoryController extends BaseController
{
    //add to the parent constructor
    public function __construct($action, $urlValues)
    {
        parent::__construct($action, $urlValues);

        //create the model object
        require("models/client.php");
        require("classes/FormValidator.php");
        $this->model = new CategoryModel();
    }

    //default method
    protected function index()
    {
        $this->view->output($this->model->index());
    }

    protected function newClient()
    {
        if($this->request->httpMethod() === "POST"){

            $validations = array(
                'name' => 'anything',
                'lastname' => 'anything',
                'email' => 'email',
                'password'=>'anything',
                'confirm_password'=>'anything');

            $required = array('name','lastname', 'email', 'password', 'confirm_password');

            $validator = new FormValidator($validations, $required);

            if($validator->validate($this->request->body())) {
                $data = $validator->sanatize($this->request->body());

                $id = $this->model->creatNewClient($data);

                if($id !== null) {
                    header('Location: ' . $this->url->generate("/client"));
                    exit();
                }
            }
        }

        $this->view->output($this->model->newClient());
    }
}
