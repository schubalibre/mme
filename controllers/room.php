<?php
/**
 * Created by PhpStorm.
 * User: roberto
 * Date: 25.11.15
 * Time: 15:07
 * 
 * BACKEND: Rooms werden angezeigt
 */

class RoomController extends BaseController
{
    //add to the parent constructor
    public function __construct($action, $urlValues)
    {
        parent::__construct($action, $urlValues);
        //create the model object
        require("models/room.php");
        $this->model = new RoomModel();

        require("helpers/formValidator.php");
        require("helpers/upload.php");

        if($_SESSION['HTTP_USER_AGENT'] != sha1($_SERVER['HTTP_USER_AGENT'])) {
            header('Location: ' . $this->url->generate("/backend/login"));
            exit();
        }
    }

    public function indexAction()
    {
        $this->model->getAllRooms();
        $this->view->output($this->model->index());
    }

    public function newAction()
    {
        $errors = null;

        if($this->request->httpMethod() === "POST") {

            $this->request->body()->slider = $this->request->body()->slider === "true" ? true : false;

            /*** a new validation instance ***/
            $val = new FormValidator();

            /*** use POST as the source ***/
            $val->addSource($this->request->body());

            /*** an array of rules ***/
            $rules_array = array(
                'department_id'=>array('type'=>'numeric', 'required'=>true, 'min'=>1, 'max'=>999999, 'trim'=>true),
                'client_id'=>array('type'=>'numeric', 'required'=>true, 'min'=>1, 'max'=>999999, 'trim'=>true),
                'name'=>array('type'=>'string', 'required'=>true, 'min'=>3, 'max'=>255, 'trim'=>true),
                'title'=>array('type'=>'string', 'required'=>true, 'min'=>3, 'max'=>255, 'trim'=>true),
                'description'=>array('type'=>'string', 'required'=>true, 'min'=>3, 'max'=>255, 'trim'=>true),
                'img'=>array('type'=>'string', 'required'=>true, 'min'=>3, 'max'=>255, 'trim'=>true),
                'slider'=>array('type'=>'bool', 'required'=>false, false, false, false)
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

                $handle = new upload($_FILES['image']);

                if ($handle->uploaded) {

                    $handle->allowed = array('image/*');
                    $handle->process('images');

                    if ($handle->processed) {

                        $name = $handle->file_dst_name;

                        $handle->file_name_body_pre   = 'thumb_';
                        $handle->image_resize         = true;
                        $handle->image_x              = 600;
                        $handle->image_ratio_y        = true;
                        $handle->process('images/thumbnails');

                        if ($handle->processed) {

                            $handle->clean();
                            $data->img = $name;
                            $id = $this->model->insertRoom($data);

                            if(is_numeric($id) && $id > 0) {
                                if($this->request->xmlhttprequest()){
                                    $this->view->ajaxRespon($this->model->ajaxMSG("Der Raum wurde erfolgreich erstellt."));
                                }else{
                                    header('Location: ' . $this->url->generate("/room"));
                                }
                                exit();
                            }
                        } else {
                            $errors = $handle->error;
                        }
                    } else {
                        $errors = $handle->error;
                    }
                }
            }
        }

        if($this->request->xmlhttprequest()){
            $this->view->ajaxRespon($this->model->newRoom($errors));
        }else{
            $this->view->output($this->model->newRoom($errors));
        }
    }

    public function updateAction()
    {
        $errors = null;

        $id = $this->request->uriValues()->id;

        if($this->request->httpMethod() === "POST"){

            $this->request->body()->slider = $this->request->body()->slider === "true" ? true : false;

            /*** a new validation instance ***/
            $val = new FormValidator();

            /*** use POST as the source ***/
            $val->addSource($this->request->body());

            /*** an array of rules ***/
            $rules_array = array(
                'id'=>array('type'=>'numeric', 'required'=>true, 'min'=>1, 'max'=>999999, 'trim'=>true),
                'department_id'=>array('type'=>'numeric', 'required'=>true, 'min'=>1, 'max'=>999999, 'trim'=>true),
                'client_id'=>array('type'=>'numeric', 'required'=>true, 'min'=>1, 'max'=>999999, 'trim'=>true),
                'name'=>array('type'=>'string', 'required'=>true, 'min'=>3, 'max'=>255, 'trim'=>true),
                'title'=>array('type'=>'string', 'required'=>true, 'min'=>3, 'max'=>255, 'trim'=>true),
                'description'=>array('type'=>'string', 'required'=>true, 'min'=>3, 'max'=>255, 'trim'=>true),
                'img'=>array('type'=>'string', 'required'=>false, 'min'=>3, 'max'=>255, 'trim'=>true),
                'slider'=>array('type'=>'bool', 'required'=>false, false, false, false)
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

                $rows = 0;

                if (isset($_FILES['img']) && $_FILES['img']['size'] > 0) {

                    $handle = new upload($_FILES['img']);

                    if ($handle->uploaded) {

                        $handle->allowed = array('image/*');
                        $handle->process('images');

                        if ($handle->processed) {

                            $name = $handle->file_dst_name;

                            $handle->file_name_body_pre = 'thumb_';
                            $handle->image_resize = true;
                            $handle->image_x = 600;
                            $handle->image_ratio_y = true;
                            $handle->process('images/thumbnails');

                            if ($handle->processed) {

                                $handle->clean();
                                $data->img = $name;
                                $rows = $this->model->updateRoom($data);

                            } else {
                                $errors = $handle->error;
                            }

                        } else {
                            $errors = $handle->error;
                        }
                    }
                }else{
                    $rows = $this->model->updateRoom($data);
                }

                if(is_int($rows) && $rows > 0) {
                    if($this->request->xmlhttprequest()){
                        $this->view->ajaxRespon($this->model->ajaxMSG("Der Raum wurde erfolgreich bearbeitet."));
                    }else{
                        header('Location: ' . $this->url->generate("/article"));
                    }
                    exit();
                }
            }
        }

        if($id != ""){
            $this->model->getRoom($id);
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

            $validations = array(
                'id' => 'number');

            $required = array('id');

            $validator = new FormValidator($validations, $required);

            if($validator->validate($this->request->uriValues())) {
                $data = $validator->sanatize($this->request->uriValues());
                $rows = -1;
                if ($this->model->deleteImagesFromDisk($data)){
                   $rows = $this->model->deleteRoom($data);
                }

                if($rows > 0) {
                    header('Location: ' . $this->url->generate("/Room"));
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