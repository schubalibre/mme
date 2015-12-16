<?php
/*
 * Project: ODDS & ENDS
 * File: /controllers/admin.php
 * Purpose: controller for the admin of the app.
 * Author: Robert Dziuba & Inga Schwarze
 */

class AdminController extends BaseController
{
    //add to the parent constructor
    public function __construct($action, $urlValues) {
        parent::__construct($action, $urlValues);

        //create the model object
        require("models/admin.php");
        $this->model = new AdminModel();
    }

    //default method
    protected function index()
    {
        $this->view->output($this->model->index());
    }

    //default method
    protected function department()
    {

        if($this->request->httpMethod() != "GET"){
            var_dump($this->request);
            exit();
        }

        if($this->urlValues['rest'] == "new"){

            if($this->request->body()) {
                if (isset($this->request->body()->departmentName) && !empty($this->request->body(
                    )->departmentName)
                ) {

                    $name = strtolower($this->request->body()->departmentName);
                    $id = $this->model->departmentPost($name);
                    if ($id) {
                        header("Location: http://mme.local/admin/department/");
                    }
                }
            }

            $this->view = new View(get_class($this), "departmentNew");
            $this->view->output($this->model->departmentNew());

        }elseif($this->urlValues['rest'] == "update") {

            if (isset($this->request->uriValues()->id) && !empty($this->request->uriValues()->id)
            ) {
                $id = $this->request->uriValues()->id;

                if($this->request->body()) {
                    if (isset($this->request->body()->departmentName) && !empty($this->request->body(
                        )->departmentName)
                    ) {
                        $name = strtolower($this->request->body()->departmentName);
                        $id = $this->model->departmentUpdate($id, $name);
                        if ($id) {
                            header("Location: http://mme.local/admin/department/");
                        }

                    }
                }

                $this->view = new View(get_class($this), "departmentUpdate");
                $this->view->output($this->model->departmentGet($id));
                exit();
            }

            echo "error no id posted";

        }elseif($this->urlValues['rest'] == "delete"){

            if($this->request->uriValues()) {

                if (isset($this->request->uriValues()->id) && !empty($this->request->uriValues()->id)
                ) {
                    $id = $this->request->uriValues()->id;

                    if ($this->model->departmentDelete($id)) {
                        header("Location: http://mme.local/admin/department/");
                    }
                }
            }

            $this->view = new View(get_class($this), "department");
            $this->view->output($this->model->department());

        }else{

            $this->view->output($this->model->department());
        }

    }
}

?>
