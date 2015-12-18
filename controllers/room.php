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

        require("classes/FormValidator.php");
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
                'image' => 'anything'
            );

            $required = array('department_id', 'client_id', 'name', 'title', 'description', 'image');

            $validator = new FormValidator($validations, $required);

            if ($validator->validate($this->request->body())) {
                $data = $validator->sanatize($this->request->body());

                $id = $this->model->insertRoom($data);

                if ($id !== null) {
                    header('Location: '.$this->url->generate("/room"));
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

                $rows = $this->model->updateRoom($data);

                if($rows > 0) {
                    header('Location: ' . $this->url->generate("/Room"));
                    exit();
                }
            }
        }

        if($id != 0){
            $this->model->getRoom($id);
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

                $rows = $this->model->deleteRoom($data);

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