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

        return $this->viewModel;
    }

    public function getAllRooms(){
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
       echo "<pre>";
        var_dump((int) $data->department_id);

        try
        {
            $sql = 'INSERT INTO room SET
                    department_id = :department_id,
                    client_id = :client_id,
                    name = :name,
                    title = :title,
                    description = :description,
                    image = :image,
                    updated_at = now(),
                    created_at = now()';
            $s = $this->database->prepare($sql);
            $s->bindValue(':department_id', (int) $data->department_id);
            $s->bindValue(':client_id', (int) $data->client_id);
            $s->bindValue(':name', $data->name);
            $s->bindValue(':title', $data->title);
            $s->bindValue(':description', $data->description);
            $s->bindValue(':image', $data->image);
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

        $this->viewModel->set("pageTitle", "update Department - ODDS&amp;ENDS");
        return $this->viewModel;
    }

    public function updateRoom($data)
    {
        try
        {
            $sql = 'UPDATE room SET
                    name = :name,
                    updated_at = now()
                    WHERE id = :id';
            $s = $this->database->prepare($sql);
            $s->bindValue(':name', $data->name);
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