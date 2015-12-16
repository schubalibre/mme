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
        require("classes/FormValidator.php");
    }

    //default method
    protected function indexAction()
    {
        $this->view->output($this->model->index());
    }

    protected function newAction()
    {
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

                if ($id !== null) {
                    header('Location: '.$this->url->generate("/category"));
                    exit();
                }
            }
        }

        $this->view = new View(get_class($this), "categoryForm");

        $this->view->output($this->model->newCategory());
    }

    protected function updateAction()
    {

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

                if($rows > 0) {
                    header('Location: ' . $this->url->generate("/category"));
                    exit();
                }
            }
        }

        if($this->request->uriValues()->id != 0){
            $this->view = new View(get_class($this), "categoryForm");
            $this->view->output($this->model->getCategory($this->request->uriValues()));
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
