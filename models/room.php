<?php
/*
 * Project: Nathan MVC
 * File: /models/home.php
 * Purpose: model for the home controller.
 * Author: Nathan Davison
 */

class RoomModel extends BaseModel
{
    //data passed to the home index view
    public function index()
    {
        $this->viewModel->set("pageTitle","Room");
        return $this->viewModel;
    }

    //data passed to the home index view
    public function departments($name)
    {
        $this->viewModel->set("pageTitle","Room");
        $this->viewModel->set("departmentName",$name);
        return $this->viewModel;
    }

    public function departmentsName($action)
    {
        try
        {
            $sql = "SELECT name FROM departments WHERE name = :name";
            $s = $this->database->prepare($sql);
            $s->bindValue(':name', $action);
            $s->execute();
        }
        catch (PDOException $e)
        {
            $error = 'Error fetching details details: '.$e->getMessage();
            //include $_SERVER['DOCUMENT_ROOT'] . '/vi/error_inc.php';
            exit();
        }

        $row = $s->fetch();
        return  $row['name'];
    }
}