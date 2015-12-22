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

        $department = new RoomModel();

        $department->getAllRooms();

        $this->viewModel->set("rooms", $department->viewModel->rooms);


        return $this->viewModel;
    }
}

?>
