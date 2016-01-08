<?php
/*
 * Project: ODDS & ENDS
 * File: /models/room.php
 * Purpose: model for the room controller.
 * Author: Robert Dziuba & Inga Schwarze
 */

class RoomModel extends BaseModel
{

    private $error = [];

    /**
     * ArticleModel constructor.
     */
    public function __construct()
    {

        parent::__construct();

        $this->viewModel->set("javascripts", array("backend.js","room.js"));
    }

    //data passed to the home index view
    public function index()
    {
        $this->viewModel->set("pageTitle", "Room - ODDS&amp;ENDS");

        //Modals
        $this->viewModel->set("modals", array("Room/roomFormModal.php"));

        // wir holen uns alle departments aus dem department Model
        require_once "department.php";

        $department = new DepartmentModel();

        $department->getAllDepartments();

        $this->viewModel->set("departments", $department->viewModel->departments);

        // wir holen uns alle Kunden aus dem client Model
        require_once "client.php";

        $department = new ClientModel();

        $department->getAllClients();

        $this->viewModel->set("clients", $department->viewModel->clients);

        return $this->viewModel;
    }

    public function getAllRooms(){

        try {
            $sql = 'SELECT * FROM room';
            $s = $this->database->prepare($sql);
            $s->execute();
            $result = $this->tableIdAsArrayKey($s->fetchAll(PDO::FETCH_ASSOC));
            $this->viewModel->set("rooms", $result);
        } catch (PDOException $e) {
            $this->setError('Error getting rooms: '.$e->getMessage());
        }

        return $this->viewModel;
    }

    public function newModel($errors = null)
    {
        if($errors != null) {
            $this->viewModel->set("validateError", $errors);
        }

        // wir holen uns alle departments aus dem department Model
        require_once "department.php";

        $department = new DepartmentModel();

        $department->getAllDepartments();

        $this->viewModel->set("departments", $department->viewModel->departments);

        // wir holen uns alle Kunden aus dem client Model
        require_once "client.php";

        $department = new ClientModel();

        $department->getAllClients();

        $this->viewModel->set("clients", $department->viewModel->clients);

        $this->viewModel->set("pageTitle", "new Room - ODDS&amp;ENDS");

        return $this->viewModel;
    }

    public function insertRoom($data)
    {
        try
        {
            $sql = 'INSERT INTO room SET
                    department_id = :department_id,
                    client_id = :client_id,
                    name = :name,
                    title = :title,
                    description = :description,
                    img = :image,
                    slider = :slider,
                    updated_at = now(),
                    created_at = now()';
            $s = $this->database->prepare($sql);
            $s->bindValue(':department_id', (int) $data->department_id);
            $s->bindValue(':client_id', (int) $data->client_id);
            $s->bindValue(':name', $data->name);
            $s->bindValue(':title', $data->title);
            $s->bindValue(':description', $data->description);
            $s->bindValue(':image', $data->img);
            $s->bindValue(':slider', $data->slider ? 1 : 0);
            $s->execute();

            return $this->database->lastInsertId();
        }
        catch (PDOException $e)
        {
            $this->setError('Error adding room: '.$e->getMessage());
            
            $this->viewModel->set("room",(array) $data);
        }

        return $this->viewModel;
    }

    public function updateModel($errors = null)
    {

        if($errors != null) {
            $this->viewModel->set("validateError", $errors);
        }

        // wir holen uns alle departments aus dem department Model
        require_once "department.php";

        $department = new DepartmentModel();

        $department->getAllDepartments();

        $this->viewModel->set("departments", $department->viewModel->departments);

        // wir holen uns alle Kunden aus dem client Model
        require_once "client.php";

        $department = new ClientModel();

        $department->getAllClients();

        $this->viewModel->set("clients", $department->viewModel->clients);

        $this->viewModel->set("pageTitle", "update Department - ODDS&amp;ENDS");

        return $this->viewModel;
    }

    public function updateRoom($data)
    {
        try
        {
            $sql = 'UPDATE room SET
                    name = :name,
                    department_id = :department_id,
                    client_id = :client_id,
                    name = :name,
                    title = :title,
                    description = :description,
                    img = :img,
                    slider = :slider,
                    updated_at = now()
                    WHERE id = :id';
            $s = $this->database->prepare($sql);
            $s->bindValue(':department_id', (int) $data->department_id);
            $s->bindValue(':client_id', (int) $data->client_id);
            $s->bindValue(':name', $data->name);
            $s->bindValue(':title', $data->title);
            $s->bindValue(':description', $data->description);
            $s->bindValue(':img', $data->img);
            $s->bindValue(':slider', $data->slider ? 1 : 0);
            $s->bindValue(':id', $data->id);
            $s->execute();
            return $s->rowCount();
        }
        catch (PDOException $e)
        {
            $this->setError('Error updating room: '.$e->getMessage());
        }

        return $this->viewModel;
    }

    public function getRoom($id)
    {
        try
        {
            $sql = 'SELECT * FROM room WHERE id = :id';
            $s = $this->database->prepare($sql);
            $s->bindValue(':id', $id);
            $s->execute();
            $result = $this->tableIdAsArrayKey($s->fetchAll(PDO::FETCH_ASSOC));
            if(!empty($result)){
                $this->viewModel->set("room", $result[$id]);
            }else {
                $this->setError( 'Room with id '.$id.' not found!');
            }
        }
        catch (PDOException $e)
        {
            $this->setError('Error getting room: '.$e->getMessage());
            
        }

        return $this->viewModel;
    }

    public function deleteRoom($data)
    {
        try {
            $sql = 'DELETE FROM room WHERE id = :id';
            $s = $this->database->prepare($sql);
            $s->bindValue(':id', $data->id);
            $s->execute();

            return $s->rowCount();
        } catch (PDOException $e) {
            $this->setError('Error deleting room: '.$e->getMessage());
        }

        return $this->viewModel;
    }

    public function deleteImagesFromDisk($data)
    {
        $data = $this->getRoom($data->id);

        $image = $data->room['img'];

        $path = "images/";
        $pathThumbnail = "images/thumbnails/";

        if (file_exists($path.$image)) {
            unlink($path.$image);
        } else {
            $this->setError('Could not delete '.$path.$image.', file does not exist');
        }

        if (file_exists($pathThumbnail."thumb_" . $image)) {
            unlink($pathThumbnail."thumb_" . $image);
        } else {
            $this->setError('Could not delete '.$pathThumbnail."thumb_" . $image.', file does not exist');
        }

        return true;
    }

    public function ajaxMSG($msg)
    {
        $this->viewModel->set("msg", $msg);
        return $this->viewModel;
    }
}