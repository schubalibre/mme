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

        try {
            $sql = 'SELECT r.*, i.image,  i.thumbnail FROM room r, imagesRoom i WHERE i.room_id = r.id';
            $s = $this->database->prepare($sql);
            $s->execute();
            $result = $this->tableIdAsArrayKey($s->fetchAll(PDO::FETCH_ASSOC));
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
            $result = $this->tableIdAsArrayKey($s->fetchAll(PDO::FETCH_ASSOC));
            if(!empty($result)){
                $this->viewModel->set("image", $result[$id]);
            }else {
                $error[] = 'Department with id '.$id.' not found!';
                $this->viewModel->set("errors", $error);
            }
        }
        catch (PDOException $e)
        {
            $this->setError('Error getting category: '.$e->getMessage());
            
        }
    }

    public function getAllImages(){

        try
        {
            $sql = 'SELECT * FROM imagesRoom';
            $s = $this->database->prepare($sql);
            $s->execute();
            $result = $this->tableIdAsArrayKey($s->fetchAll(PDO::FETCH_ASSOC));
            $this->viewModel->set("images", $result);
        } catch (PDOException $e) {
            $this->setError('Error getting images: '.$e->getMessage());
            
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
            $this->setError('Error adding images: '.$e->getMessage());
            
            $this->viewModel->set("room",(array) $data);
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
            $this->setError('Error adding room: '.$e->getMessage());
            
            $this->viewModel->set("room",(array) $data);
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
            $this->setError('Error updating room: '.$e->getMessage());
        }
    }

    public function getRoom($id)
    {
        try
        {
            $sql = 'SELECT r.*, i.image,  i.thumbnail FROM room r, imagesRoom i WHERE i.room_id = r.id AND r.id = :id';
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
            $this->setError('Error deleting room: '.$e->getMessage());
        }

        return $this->viewModel;
    }

    private function tableIdAsArrayKey($data)
    {
        $myArray = null;
        foreach ($data as $value) {
            $myArray[$value['id']] = $value;
        }

        return $myArray;
    }

    public function getImages($data)
    {
        try
        {
            $sql = 'SELECT * FROM imagesRoom WHERE room_id = :id';
            $s = $this->database->prepare($sql);
            $s->bindValue(':id', $data->id);
            $s->execute();
            $result = $this->tableIdAsArrayKey($s->fetchAll(PDO::FETCH_ASSOC));
            $this->viewModel->set("images", $result);
        } catch (PDOException $e) {
            $this->setError('Error getting images: '.$e->getMessage());
        }

        return $this->viewModel;
    }

    public function deleteImagesFromDisk($data)
    {
        $path = "images/";
        $pathThumbnail = "images/thumbnails/";

        $this->getImages($data);

        foreach($this->viewModel->get("images") as $file) {

            if (file_exists($path.$file['image'])) {
                unlink($path.$file['image']);
                echo 'File '.$path.$file['image'].' has been deleted';
            } else {
                $this->setError('Could not delete '.$path.$file['image'].', file does not exist');
            }

            if (file_exists($pathThumbnail.$file['thumbnail'])) {
                unlink($pathThumbnail.$file['thumbnail']);
                echo 'File '.$pathThumbnail.$file['thumbnail'].' has been deleted';
            } else {
                $this->setError('Could not delete '.$pathThumbnail.$file['thumbnail'].', file does not exist');
            }
        }

        return true;
    }

    public function deleteImages($data)
    {
        try
        {
            $sql = 'Delete FROM imagesRoom WHERE room_id = :id';
            $s = $this->database->prepare($sql);
            $s->bindValue(':id', $data->id);
            $s->execute();
            return $s->rowCount();
        }
        catch (PDOException $e)
        {
            $this->setError('Error deleting room: '.$e->getMessage());
        }
    }
    
    private function setError($error){
        array_push($this->error,$error);
        $this->viewModel->set("errors",$this->error);
    }
}