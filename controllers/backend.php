<?php
/*
 * Project: ODDS & ENDS
 * File: /controllers/backend.php
 * Purpose: controller for the backend of the app.
 * Author: Robert Dziuba & Inga Schwarze
 */

class BackendController extends BaseController
{
    //add to the parent constructor
    public function __construct($action, $urlValues)
    {
        parent::__construct($action, $urlValues);

        //create the model object
        require("models/backend.php");
        $this->model = new BackendModel();

        require("helpers/formValidator.php");

    }

    //default method
    protected function indexAction()
    {
        if($_SESSION['HTTP_USER_AGENT'] != sha1($_SERVER['HTTP_USER_AGENT'])) {
            header('Location: ' . $this->url->generate("/backend/login"));
            exit();
        }

        $this->view->output($this->model->index());
    }

    //default method
    protected function loginAction()
    {

        $error = null;

        if($this->request->httpMethod() === "POST"){

            $validations = array(
                'email' => 'email',
                'password' => 'anything'
            );

            $required = array('email','password');

            $validator = new FormValidator($validations, $required);

            $data = $this->request->body();

            if ($validator->validate($data)) {

                $data = $validator->sanatize($data);

                $client = $this->model->makeLogin($data);

                if ($client !== null) {

                    $_SESSION['HTTP_USER_AGENT'] = sha1($_SERVER['HTTP_USER_AGENT']);

                    if($this->request->xmlhttprequest()){
                        $this->view->ajaxRespon($this->model->LoginOk(
                            array(
                                'authentication' => true,
                                'name' => $client[0]['name'],
                                'lastname' => $client[0]['lastname']
                            )
                        ));
                        exit();
                    }else {
                        header('Location: '.$this->url->generate("/backend"));
                        exit();
                    }
                }
            }else{
                $error = $validator->getErrors();
            }
        }
        if($this->request->xmlhttprequest()) {
            $this->view->ajaxRespon($this->model->login($error));
        }else{
            $this->view->output($this->model->login($error));
        }
    }
}