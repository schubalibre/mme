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

        $errors = null;

        if($this->request->httpMethod() === "POST"){

            /*** a new validation instance ***/
            $val = new FormValidator();

            /*** use POST as the source ***/
            $val->addSource($this->request->body());

            /*** an array of rules ***/
            $rules_array = array(
                'email'=>array('type'=>'email', 'required'=>true, 'min'=>1, 'max'=>999999, 'trim'=>true),
                'password'=>array('type'=>'string', 'required'=>true, 'min'=>1, 'max'=>999999, 'trim'=>true)
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
            }
        }
        if($this->request->xmlhttprequest()) {
            $this->view->ajaxRespon($this->model->login($errors));
        }else{
            $this->view->output($this->model->login($errors));
        }
    }

    public function logoutAction(){
        session_destroy();
        header('Location: '.$this->url->generate("/backend"));
        exit();
    }
}