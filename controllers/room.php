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
    }

    public function indexAction()
    {
        $this->model->getAllRooms();
        $this->model->getAllByRoomImages();
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
                'description' => 'anything'
            );

            $required = array('department_id', 'client_id', 'name', 'title', 'description');

            $validator = new FormValidator($validations, $required);

            if ($validator->validate($this->request->body())) {
                $data = $validator->sanatize($this->request->body());

                $id = $this->model->insertRoom($data);

                $imagesSaved = $this->saveImages($id);

                if ($id !== null && $imagesSaved) {
                    header('Location: '.$this->url->generate("/room"));
                    exit();
                }
            }else{
                $error = $validator->getErrors();
            }
        }

        $this->view->output($this->model->newModel($error));
    }

    private function saveImages($room_id)
    {
        $saved = true;

        // hier müssen wir das Array umdrehen da html5 das total bescheuert gelöst hat.....
        $files=array();
        $fdata=$_FILES['images'];
        if(is_array($fdata['name'])){
            for($i=0;$i<count($fdata['name']);++$i){
                $files[]=array(
                    'name'     => $fdata['name'][$i],
                    'tmp_name' => $fdata['tmp_name'][$i],
                    'type' => $fdata['type'][$i],
                    'error' => $fdata['error'][$i],
                    'size' => $fdata['size'][$i]
                );
            }
        }
        else $files[]=$fdata;

        if (!empty($files)) {
            foreach($files as $image){
                $upload = Upload::factory('images');
                $upload->file($image);
                $upload->callbacks($this, array('resizeImage'));
                $results = $upload->upload();
                $id = $this->model->insertImage($room_id,$results);

                // wenn beim speichern was schief geht
                if($id == null){
                    $saved = false;
                    break;
                }
            }
        }

        return $saved;
    }

    public function resizeImage($object)
    {
        $max_width = 600;
        $max_height = 1000;

        list($orig_width, $orig_height) = getimagesize($object->file['tmp_name']);

        $width = $orig_width;
        $height = $orig_height;

        # taller
        if ($height > $max_height) {
            $width = ($max_height / $height) * $width;
            $height = $max_height;
        }

        # wider
        if ($width > $max_width) {
            $height = ($max_width / $width) * $height;
            $width = $max_width;
        }

        $image_p = imagecreatetruecolor($width, $height);

        $imgString = file_get_contents($object->file['tmp_name']);

        $image = imagecreatefromstring($imgString);

        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);

        $name = $width.'x'.$height.'_'.sha1(mt_rand(1, 9999) . $object->file['destination'] . uniqid()) . time();

        $path = $object->file['destination'].'thumbnails/'.$name;

        /* Save image */
        switch ($object->file['mime']) {
            case 'image/jpeg':
                imagejpeg($image_p, $path, 100);
                break;
            case 'image/png':
                imagepng($image_p, $path, 0);
                break;
            case 'image/gif':
                imagegif($image_p, $path);
                break;
            default:
                exit;
                break;
        }

        $object->file['thumbnail']['name'] = $name;
        $object->file['thumbnail']['full_path'] = $path;
    }

    public function resize_Image($object) {

        var_dump($object->file);

        $width = 400;
        $height = 300;
        /* Get original image x y*/
        list($w, $h) = getimagesize($object->file['tmp_name']);
        /* calculate new image size with ratio */
        $ratio = max($width/$w, $height/$h);
        $h = ceil($height / $ratio);
        $x = ($w - $width / $ratio) / 2;
        $w = ceil($width / $ratio);
        /* new file name */
        $path = 'images/thumbnails/'.$width.'x'.$height.'_'.$object->file['original_filename'];
        /* read binary data from image file */
        $imgString = file_get_contents($object->file['tmp_name']);
        /* create image from string */
        $image = imagecreatefromstring($imgString);
        $tmp = imagecreatetruecolor($width, $height);
        imagecopyresampled($tmp, $image,
            0, 0,
            $x, 0,
            $width, $height,
            $w, $h);
        /* Save image */
        switch ($object->file['mime']) {
            case 'image/jpeg':
                imagejpeg($tmp, $path, 100);
                break;
            case 'image/png':
                imagepng($tmp, $path, 0);
                break;
            case 'image/gif':
                imagegif($tmp, $path);
                break;
            default:
                exit;
                break;
        }
        return $path;
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
                $rows = -1;
                if ($this->model->deleteImagesFromDisk($data)){
                   $this->model->deleteImages($data);
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

    public function ajaxAction() {
        if($this->request->httpMethod() === "GET") {

            $validations = array(
                'id' => 'number'
            );

            $required = array('id');

            $validator = new FormValidator($validations, $required);

            if ($validator->validate($this->request->uriValues())) {
                $data = $validator->sanatize($this->request->uriValues());
                $this->view->ajaxRespon($this->model->getRoom($data->id));

            }
        }
    }

}