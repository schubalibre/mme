<?php
/*
 * Project: ODDS & ENDS
 * File: /models/room.php
 * Purpose: model for the room controller.
 * Author: Robert Dziuba & Inga Schwarze
 */

class RoomModel extends BaseModel
{
    //data passed to the home index view
    public function index()
    {
        $this->viewModel->set("pageTitle", "Room - ODDS&amp;ENDS");

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

        // TODO alle Bilder uber diese Query holen!
        try {
            $sql = 'SELECT * FROM room';
            $s = $this->database->prepare($sql);
            $s->execute();
            $result = $this->tableIdasArrayKey($s->fetchAll(PDO::FETCH_ASSOC));
            $this->viewModel->set("rooms", $result);
        } catch (PDOException $e) {
            $error = 'Error getting rooms: '.$e->getMessage();
            $this->viewModel->set("dbError", $error);
        }
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

    public function getImage($id){

        try
        {
            $sql = 'SELECT * FROM imagesRoom WHERE id = :id';
            $s = $this->database->prepare($sql);
            $s->bindValue(':id', $id);
            $s->execute();
            $result = $this->tableIdasArrayKey($s->fetchAll(PDO::FETCH_ASSOC));
            if(!empty($result)){
                $this->viewModel->set("image", $result[$id]);
            }else {
                $error[] = 'Department with id '.$id.' not found!';
                $this->viewModel->set("errors", $error);
            }
        }
        catch (PDOException $e)
        {
            $error[] = 'Error getting category: '.$e->getMessage();
            $this->viewModel->set("errors",$error);
        }
    }

    public function getAllImages(){

        try
        {
            $sql = 'SELECT * FROM imagesRoom';
            $s = $this->database->prepare($sql);
            $s->execute();
            $result = $this->tableIdasArrayKey($s->fetchAll(PDO::FETCH_ASSOC));
            $this->viewModel->set("images", $result);
        } catch (PDOException $e) {
            $error = 'Error getting images: '.$e->getMessage();
            $this->viewModel->set("dbError", $error);
        }
    }

    public function getAllByRoomImages(){
        $this-> getAllImages();
        $images = $this->viewModel->get("images");
        $sorted = null;
        if(sizeof($images) > 0) {
            foreach ($images as $image) {
                $sorted[$image['room_id']][] = $image;
            }
        }

        $this->viewModel->set("images", $sorted);
    }

    public function insertImage($room_id,$data){

        try
        {
            $sql = 'INSERT INTO imagesRoom SET
                    room_id = :room_id,
                    image = :image,
                    thumbnail = :thumbnail,
                    updated_at = now(),
                    created_at = now()';
            $s = $this->database->prepare($sql);
            $s->bindValue(':room_id', (int) $room_id);
            $s->bindValue(':image', $data['filename']);
            $s->bindValue(':thumbnail', $data['thumbnail']['name']);
            $s->execute();

            return $this->database->lastInsertId();
        }
        catch (PDOException $e)
        {
            $error[] = 'Error adding image: '.$e->getMessage();
            $this->viewModel->set("room",(array) $data);
            $this->viewModel->set("errors",$error);
        }
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
                    updated_at = now(),
                    created_at = now()';
            $s = $this->database->prepare($sql);
            $s->bindValue(':department_id', (int) $data->department_id);
            $s->bindValue(':client_id', (int) $data->client_id);
            $s->bindValue(':name', $data->name);
            $s->bindValue(':title', $data->title);
            $s->bindValue(':description', $data->description);
            $s->execute();

            return $this->database->lastInsertId();
        }
        catch (PDOException $e)
        {
            $error[] = 'Error adding room: '.$e->getMessage();
            $this->viewModel->set("room",(array) $data);
            $this->viewModel->set("errors",$error);
        }
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
                    image = :image,
                    updated_at = now()
                    WHERE id = :id';
            $s = $this->database->prepare($sql);
            $s->bindValue(':department_id', (int) $data->department_id);
            $s->bindValue(':client_id', (int) $data->client_id);
            $s->bindValue(':name', $data->name);
            $s->bindValue(':title', $data->title);
            $s->bindValue(':description', $data->description);
            $s->bindValue(':image', $data->image);
            $s->bindValue(':id', $data->id);
            $s->execute();
            return $s->rowCount();
        }
        catch (PDOException $e)
        {
            $error[] = 'Error updating room: '.$e->getMessage();
            $this->viewModel->set("errors",$error);
        }
    }

    public function getRoom($id)
    {
        try
        {
            $sql = 'SELECT * FROM room WHERE id = :id';
            $s = $this->database->prepare($sql);
            $s->bindValue(':id', $id);
            $s->execute();
            $result = $this->tableIdasArrayKey($s->fetchAll(PDO::FETCH_ASSOC));
            if(!empty($result)){
                $this->viewModel->set("room", $result[$id]);
            }else {
                $error[] = 'Department with id '.$id.' not found!';
                $this->viewModel->set("errors", $error);
            }
        }
        catch (PDOException $e)
        {
            $error[] = 'Error getting category: '.$e->getMessage();
            $this->viewModel->set("errors",$error);
        }
    }

    public function deleteRoom($data)
    {
        try
        {
            $sql = 'Delete FROM room WHERE id = :id';
            $s = $this->database->prepare($sql);
            $s->bindValue(':id', $data->id);
            $s->execute();
            return $s->rowCount();
        }
        catch (PDOException $e)
        {
            $error[] = 'Error deleting room: '.$e->getMessage();
            $this->viewModel->set("errors",$error);
        }
    }

    private function tableIdasArrayKey($data)
    {
        $myArray = null;
        foreach ($data as $value) {
            $myArray[$value['id']] = $value;
        }

        return $myArray;
    }
}