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
    }

    //default method
    protected function indexAction()
    {
        $this->view->output($this->model->index());
    }

    protected function newAction($id){
        $result = $this->model->departmentsName($this->request->uriValues()->action);

        $this->view->output($this->model->departments($result));
    }

    protected function saveAction(){
        $result = $this->model->departmentsName($this->request->uriValues()->action);

        $this->view->output($this->model->departments($result));
    }

    protected function updateAction(){
        $result = $this->model->departmentsName($this->request->uriValues()->action);

        $this->view->output($this->model->departments($result));
    }

    protected function deleteAction(){
        $result = $this->model->departmentsName($this->request->uriValues()->action);

        $this->view->output($this->model->departments($result));
    }


}