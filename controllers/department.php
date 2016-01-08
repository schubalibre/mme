<?php
/**
 * Created by PhpStorm.
 * User: roberto
 * Date: 17/12/15
 * Time: 21:40
 */

class DepartmentController extends BaseController
{
    //add to the parent constructor
    public function __construct($action, $urlValues)
    {
        parent::__construct($action, $urlValues);
        //create the model object
        require("models/department.php");
        $this->model = new DepartmentModel();

        require("helpers/formValidator.php");

        if($_SESSION['HTTP_USER_AGENT'] != sha1($_SERVER['HTTP_USER_AGENT'])) {
            header('Location: ' . $this->url->generate("/backend/login"));
            exit();
        }
    }

    public function indexAction()
    {
        $this->model->getAllDepartments();
        $this->view->output($this->model->index());
    }

    public function newAction()
    {
        $error = null;

        if($this->request->httpMethod() === "POST") {

            $validations = array(
                'name' => 'anything'
            );

            $required = array('name');

            $validator = new FormValidator($validations, $required);

            if ($validator->validate($this->request->body())) {
                $data = $validator->sanatize($this->request->body());

                $id = $this->model->insertDepartment($data);

                if ($id !== null) {
                    header('Location: '.$this->url->generate("/department"));
                    exit();
                }
            }else{
                $error = $validator->getErrors();
            }
        }

        $this->view->output($this->model->newModel($error));
    }

    public function updateAction()
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

                $rows = $this->model->updateDepartment($data);

                if($rows > 0) {
                    header('Location: ' . $this->url->generate("/department"));
                    exit();
                }
            }
        }

        if($id != 0){
            $this->model->getDepartment($id);
            $this->view->output($this->model->updateModel($error));
            exit();
        }

        // if no id is set
        require("controllers/error.php");
        $controller = new ErrorController("badurl",$this->urlValues);
        $controller->executeAction();
    }

    public function deleteAction()
    {
        if($this->request->httpMethod() === "GET"){

            $validations = array(
                'id' => 'number');

            $required = array('id');

            $validator = new FormValidator($validations, $required);

            if($validator->validate($this->request->uriValues())) {
                $data = $validator->sanatize($this->request->uriValues());

                $rows = $this->model->deleteDepartment($data);

                if($rows > 0) {
                    header('Location: ' . $this->url->generate("/department"));
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
