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
        $errors = null;

        if($this->request->httpMethod() === "POST") {

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

                $id = $this->model->insertDepartment($data);

                if(is_numeric($id) && $id > 0) {
                    if($this->request->xmlhttprequest()){
                        $this->view->ajaxRespon($this->model->ajaxMSG("Das Department wurde erfolgreich erstellt."));
                    }else{
                        header('Location: '.$this->url->generate("/department"));
                    }
                    exit();
                }
            }
        }

        if($this->request->xmlhttprequest()){
            $this->view->ajaxRespon($this->model->newModel($errors));
        }else{
            $this->view->output($this->model->newModel($errors));
        }
    }

    public function updateAction()
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

                $rows = $this->model->updateDepartment($data);

                if(is_int($rows) && $rows > 0) {
                    if($this->request->xmlhttprequest()){
                        $this->view->ajaxRespon($this->model->ajaxMSG("Das Department wurde erfolgreich bearbeitet."));
                    }else{
                        header('Location: ' . $this->url->generate("/department"));
                    }
                    exit();
                }
            }
        }

        if($id != ""){
            $this->model->getDepartment($id);
            if($this->request->xmlhttprequest()){
                $this->view->ajaxRespon($this->model->updateModel($errors));
            }else{
                $this->view->output($this->model->updateModel($errors));
            }
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

                $rows = $this->model->deleteDepartment($data);

                if ($rows > 0) {
                    header('Location: '.$this->url->generate("/department"));
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
