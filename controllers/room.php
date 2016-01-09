<?php
/**
 * Created by PhpStorm.
 * User: roberto
 * Date: 25.11.15
 * Time: 15:07
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
        $error = null;

        if($this->request->httpMethod() === "POST") {

            $validations = array(
                'department_id' => 'number',
                'client_id' => 'number',
                'name' => 'anything',
                'title' => 'anything',
                'description' => 'anything',
                'image' => 'anything',
                'slider' => 'number'
            );

            $required = array('department_id', 'client_id', 'name', 'title', 'description','image');

            $validator = new FormValidator($validations, $required);

            if ($validator->validate($this->request->body())) {

                $data = $validator->sanatize($this->request->body());

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
                            echo 'error : ' . $handle->error;
                        }

                    } else {
                        echo 'error : ' . $handle->error;
                    }
                }
            }else{
                $error = $validator->getErrors();
            }
        }

        if($this->request->xmlhttprequest()){
            $this->view->ajaxRespon($this->model->newRoom($error));
        }else{
            $this->view->output($this->model->newRoom($error));
        }
    }

    public function updateAction()
    {
        $error = null;
        $id = $this->request->uriValues()->id;

        if($this->request->httpMethod() === "POST"){

            $validations = array(
                'id' => 'number',
                'department_id' => 'number',
                'client_id' => 'number',
                'name' => 'anything',
                'title' => 'anything',
                'description' => 'anything',
                'img' => 'anything',
                'slider' => 'number'
            );

            $required = array('id','department_id', 'client_id', 'name', 'title', 'description','img');

            $validator = new FormValidator($validations, $required);

            $data = $this->request->body();

            if($validator->validate($data)) {

                $data = $validator->sanatize($data);

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
                                echo 'error : '.$handle->error;
                            }

                        } else {
                            echo 'error : '.$handle->error;
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