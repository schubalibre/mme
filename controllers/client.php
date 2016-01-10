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
        $errors = null;

        if($this->request->httpMethod() === "POST") {

            /*** a new validation instance ***/
            $val = new FormValidator();

            /*** use POST as the source ***/
            $val->addSource($this->request->body());

            /*** an array of rules ***/
            $rules_array = array(
                'name'=>array('type'=>'string', 'required'=>true, 'min'=>1, 'max'=>999999, 'trim'=>true),
                'lastname'=>array('type'=>'string', 'required'=>true, 'min'=>1, 'max'=>999999, 'trim'=>true),
                'email'=>array('type'=>'email', 'required'=>true, 'min'=>1, 'max'=>999999, 'trim'=>true),
                'password'=>array('type'=>'string', 'required'=>true, 'min'=>1, 'max'=>999999, 'trim'=>true),
                'confirm_password'=>array('type'=>'string', 'required'=>false, 'min'=>1, 'max'=>999999, 'trim'=>true)
            );

            /*** add an array of rules ***/
            $val->addRules($rules_array);

            /*** run the validation rules ***/
            $val->run();

            /*** if there are errors show them ***/
            if(sizeof($val->errors) > 0) {
                $errors = $val->errors;
            }else{

                $data = $val->getSanitized();

                $id = $this->model->insertClient($data);

                if ($id !== null) {
                    header('Location: '.$this->url->generate("/client"));
                    exit();
                }
            }
        }

        $this->view->output($this->model->newModel($errors));
    }

    protected function updateAction()
    {
        $errors = null;

        $id = $this->request->uriValues()->id;

        if($this->request->httpMethod() === "POST"){

            /*** a new validation instance ***/
            $val = new FormValidator();

            /*** use POST as the source ***/
            $val->addSource($this->request->body());

            /*** an array of rules ***/
            $rules_array = array(
                'id'=>array('type'=>'numeric', 'required'=>true, 'min'=>1, 'max'=>999999, 'trim'=>true),
                'name'=>array('type'=>'string', 'required'=>true, 'min'=>1, 'max'=>999999, 'trim'=>true),
                'lastname'=>array('type'=>'string', 'required'=>true, 'min'=>1, 'max'=>999999, 'trim'=>true),
                'email'=>array('type'=>'email', 'required'=>true, 'min'=>1, 'max'=>999999, 'trim'=>true),
                'password'=>array('type'=>'string', 'required'=>true, 'min'=>1, 'max'=>999999, 'trim'=>true),
                'confirm_password'=>array('type'=>'string', 'required'=>false, 'min'=>1, 'max'=>999999, 'trim'=>true)
            );

            /*** add an array of rules ***/
            $val->addRules($rules_array);

            /*** run the validation rules ***/
            $val->run();

            /*** if there are errors show them ***/
            if(sizeof($val->errors) > 0) {
                $errors = $val->errors;
            }else{

                $data = $val->getSanitized();

                $rows = $this->model->updateClient($data);

                if($rows > 0) {
                    header('Location: ' . $this->url->generate("/client"));
                    exit();
                }
            }
        }

        if($id != 0){
            $this->model->getClient($id);
            $this->view->output($this->model->updateModel($errors));
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

            /*** a new validation instance ***/
            $val = new FormValidator();

            /*** use POST as the source ***/
            $val->addSource($this->request->body());

            /*** an array of rules ***/
            $rules_array = array(
                'id'=>array('type'=>'numeric', 'required'=>true, 'min'=>1, 'max'=>999999, 'trim'=>true)
            );

            /*** add an array of rules ***/
            $val->addRules($rules_array);

            /*** run the validation rules ***/
            $val->run();

            /*** if there are errors show them ***/
            if(sizeof($val->errors) > 0) {
                $errors = $val->errors;
            }else{

                $data = $val->getSanitized();

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
