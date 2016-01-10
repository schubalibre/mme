<?php
/*
 * Project: ODDS & ENDS
 * File: /controllers/home.php
 * Purpose: controller for the home of the app.
 * Author: Robert Dziuba & Inga Schwarze
 */

class CategoryController extends BaseController
{
    //add to the parent constructor
    public function __construct($action, $urlValues)
    {
        parent::__construct($action, $urlValues);

        //create the model object
        require("models/category.php");
        $this->model = new CategoryModel();

        require("helpers/formValidator.php");

        if($_SESSION['HTTP_USER_AGENT'] != sha1($_SERVER['HTTP_USER_AGENT'])) {
            header('Location: ' . $this->url->generate("/backend/login"));
            exit();
        }
    }

    //default method
    protected function indexAction()
    {
        $this->model->getAllCategories();
        $this->view->output($this->model->index());
    }

    protected function newAction()
    {
        $error = null;

        if($this->request->httpMethod() === "POST"){

            $validations = array(
                'name' => 'anything'
            );

            $required = array('name');

            $validator = new FormValidator($validations, $required);

            $data = $this->request->body();

            if ($validator->validate($data)) {

                $data = $validator->sanatize($data);

                $id = $this->model->creatNewCategory($data);

                if(is_numeric($id) && $id > 0) {
                    if($this->request->xmlhttprequest()){
                        $this->view->ajaxRespon($this->model->ajaxMSG("Die Kategorie wurde erfolgreich erstellt."));
                    }else{
                        header('Location: '.$this->url->generate("/category"));
                    }
                    exit();
                }
            }else{
                $error = $validator->getErrors();
            }
        }

        if($this->request->xmlhttprequest()){
            $this->view->ajaxRespon($this->model->newCategory($error));
        }else{
            $this->view->output($this->model->newCategory($error));
        }
    }

    protected function updateAction()
    {
        $error = null;
        $id = $this->request->uriValues()->id;

        if($this->request->httpMethod() === "POST"){

            $validations = array(
                'id' => 'number',
                'name' => 'anything'
                );

            $required = array('id','name');

            $validator = new FormValidator($validations, $required);

            if($validator->validate($this->request->body())) {
                $data = $validator->sanatize($this->request->body());

                $rows = $this->model->updateCategory($data);

                if(is_int($rows) && $rows > 0) {
                    if($this->request->xmlhttprequest()){
                        $this->view->ajaxRespon($this->model->ajaxMSG("Die Kategorie wurde erfolgreich bearbeitet."));
                    }else{
                        header('Location: ' . $this->url->generate("/category"));
                    }
                    exit();
                }
            }else{
                $error = $validator->getErrors();
            }
        }

        if($id != ""){
            $this->model->getCategory($id);
            if($this->request->xmlhttprequest()){
                $this->view->ajaxRespon($this->model->updateModel($error));
            }else{
                $this->view->output($this->model->updateModel($error));
            }
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

                $rows = $this->model->deleteCategory($data);

                if($rows > 0) {
                    header('Location: ' . $this->url->generate("/category"));
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
