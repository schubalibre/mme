<?php
/*
 * Project: ODDS & ENDS
 * File: /controllers/home.php
 * Purpose: controller for the home of the app.
 * Author: Robert Dziuba & Inga Schwarze
 */

class ArticleController extends BaseController
{
    //add to the parent constructor
    public function __construct($action, $urlValues)
    {
        parent::__construct($action, $urlValues);

        //create the model object
        require("models/article.php");
        $this->model = new ArticleModel();

        require("helpers/formValidator.php");

        require("helpers/upload.php");
    }

    //default method
    protected function indexAction()
    {
        $this->model->getAllArticles();
        $this->view->output($this->model->index());
    }

    protected function newAction()
    {
        $error = null;

        if($this->request->httpMethod() === "POST"){

            $validations = array(
                'room_id' => 'number',
                'category_id' => 'number',
                'name' => 'anything',
                'title' => 'anything',
                'description' => 'anything',
                'img' => 'anything',
                'shop' => 'anything',
                'website' => 'anything'
            );

            $required = array('room_id','category_id','name','title','description','img','shop','website');

            $validator = new FormValidator($validations, $required);

            $data = $this->request->body();

            if ($validator->validate($data)) {

                $data = $validator->sanatize($data);

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
                            $id = $this->model->insertArticle($data);

                            if ($id !== null) {
                                header('Location: '.$this->url->generate("/article"));
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

        $this->view->output($this->model->newArticle($error));
    }

    protected function updateAction()
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

                $rows = $this->model->updateArticle($data);

                if($rows > 0) {
                    header('Location: ' . $this->url->generate("/article"));
                    exit();
                }
            }else{
                $error = $validator->getErrors();
            }
        }

        if($id != ""){
            $this->model->getArticle($id);
            $this->view->output($this->model->updateModel($error));
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

                $rows = -1;
                if ($this->model->deleteImagesFromDisk($data)){
                    $rows = $this->model->deleteArticle($data);
                }

                if($rows > 0) {
                    header('Location: ' . $this->url->generate("/article"));
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
