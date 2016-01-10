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
        $errors = null;

        if($this->request->httpMethod() === "POST"){

            /*** a new validation instance ***/
            $val = new FormValidator();

            /*** use POST as the source ***/
            $val->addSource($this->request->body());

            /*** an array of rules ***/
            $rules_array = array(
                'name'=>array('type'=>'string', 'required'=>true, 'min'=>3, 'max'=>255, 'trim'=>true));

            /*** add an array of rules ***/
            $val->addRules($rules_array);

            /*** run the validation rules ***/
            $val->run();

            /*** if there are errors show them ***/
            if(sizeof($val->errors) > 0) {
                $errors = $val->errors;
            }else{

                $data = $val->getSanitized();

                $id = $this->model->creatNewCategory($data);

                if(is_numeric($id) && $id > 0) {
                    if($this->request->xmlhttprequest()){
                        $this->view->ajaxRespon($this->model->ajaxMSG("Die Kategorie wurde erfolgreich erstellt."));
                    }else{
                        header('Location: '.$this->url->generate("/category"));
                    }
                    exit();
                }
            }
        }

        if($this->request->xmlhttprequest()){
            $this->view->ajaxRespon($this->model->newCategory($errors));
        }else{
            $this->view->output($this->model->newCategory($errors));
        }
    }

    protected function updateAction()
    {
        $error = null;
        $id = $this->request->uriValues()->id;

        if($this->request->httpMethod() === "POST"){

            /*** a new validation instance ***/
            $val = new FormValidator();

            /*** use POST as the source ***/
            $val->addSource($this->request->body());

            /*** an array of rules ***/
            $rules_array = array(
                'id'=>array('type'=>'numeric', 'required'=>true, 'min'=>1, 'max'=>999999, 'trim'=>true),
                'name'=>array('type'=>'string', 'required'=>true, 'min'=>3, 'max'=>255, 'trim'=>true)
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

                $rows = $this->model->updateCategory($data);

                if(is_int($rows) && $rows > 0) {
                    if($this->request->xmlhttprequest()){
                        $this->view->ajaxRespon($this->model->ajaxMSG("Die Kategorie wurde erfolgreich bearbeitet."));
                    }else{
                        header('Location: ' . $this->url->generate("/category"));
                    }
                    exit();
                }
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

            /*** a new validation instance ***/
            $val = new FormValidator();

            /*** use POST as the source ***/
            $val->addSource($this->request->uriValues());

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
            }else {

                $data = $val->getSanitized();

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
