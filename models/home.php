<?php
/* 
 * Project: ODDS & ENDS
 * File: /models/home.php
 * Purpose: model for the home controller.
 * Author: Robert Dziuba & Inga Schwarze
 */

class HomeModel extends BaseModel
{
    //data passed to the home index view
    public function index()
    {
        $this->viewModel->set("slider","Home/slider.php");
        $this->viewModel->set("site","home");
        $this->viewModel->set("pageTitle","Home - ODDS&amp;ENDS");


        // wir holen uns alle departments aus dem department Model
        require_once "room.php";

        $room = new RoomModel();

        $room->getAllRooms();

        $this->viewModel->set("rooms", $room->viewModel->rooms);

        $this->getActiveDepartments();

        return $this->viewModel;
    }

    public function getActiveDepartments()
    {
        try
        {
            $sql = 'SELECT d.id, d.name FROM room r, department d WHERE r.department_id = d.id';
            $s = $this->database->prepare($sql);
            $s->execute();
            $result = $this->tableIdAsArrayKey($s->fetchAll(PDO::FETCH_ASSOC));
            $this->viewModel->set("activeDepartments", $result);
        } catch (PDOException $e) {
            $this->setError('Error getting activ departments: '.$e->getMessage());
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

}

?>
