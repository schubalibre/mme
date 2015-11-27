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
    protected function index()
    {
        $this->view->output($this->model->index());
    }

    protected function departments($id){
        $result = $this->model->departmentsName($this->request->uriValues()->action);

        $this->view->output($this->model->departments($result));
    }

    protected function save(){
        $result = $this->model->departmentsName($this->request->uriValues()->action);

        $this->view->output($this->model->departments($result));
    }

    protected function update(){
        $result = $this->model->departmentsName($this->request->uriValues()->action);

        $this->view->output($this->model->departments($result));
    }

    protected function delete(){
        $result = $this->model->departmentsName($this->request->uriValues()->action);

        $this->view->output($this->model->departments($result));
    }


}