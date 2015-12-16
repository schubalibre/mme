<?php

/*
 * Project: ODDS & ENDS
 * File: /models/admin.php
 * Purpose: model for the furniture controller.
 * Author: Robert Dziuba & Inga Schwarze
 */
class AdminModel extends BaseModel
{
    //data passed to the home index view
    public function index()
    {
        $this->viewModel->set("pageTitle","ADMIN - ODDS&amp;ENDS");
        return $this->viewModel;
    }

    public function department()
    {
        $this->viewModel->set("pageTitle","ADMIN - ODDS&amp;ENDS");

        $departments = [];

        try
        {
            $sql = 'SELECT * FROM department ORDER BY name';
            $s = $this->database->prepare($sql);
            $s->execute();
            $result = $s->fetchAll();
            $this->viewModel->set("departments",$result);
        }
        catch (PDOException $e)
        {
            $error = 'Error getting departments: '.$e->getMessage();
            $this->viewModel->set("dbError",$error);
        }

        return $this->viewModel;
    }

    public function departmentNew()
    {
        $this->viewModel->set("pageTitle","New Room - ODDS&amp;ENDS");
        if($this->viewModel->get("departmentName") == null){
            $this->viewModel->set("departmentName","");
        }
        return $this->viewModel;

    }

    public function departmentGet($id)
    {
        $departments = [];

        try
        {
            $sql = 'SELECT * FROM department WHERE id = :id';
            $s = $this->database->prepare($sql);
            $s->bindValue(':id',$id);
            $s->execute();
            $result = $s->fetchAll(PDO::FETCH_COLUMN, 1);
            $this->viewModel->set("departmentName",ucfirst($result[0]));
        }
        catch (PDOException $e)
        {
            $error = 'Error getting departments: '.$e->getMessage();
            $this->viewModel->set("dbError",$error);
        }

        return $this->viewModel;

    }

    public function departmentPost($name)
    {
        try
        {
            $sql = 'INSERT INTO department SET name = :name';
            $s = $this->database->prepare($sql);
            $s->bindValue(':name',$name);
            $s->execute();

            return $this->database->lastInsertId();
        }
        catch (PDOException $e)
        {
            $error = 'Error adding department: '.$e->getMessage();
            $this->viewModel->set("dbError",$error);
            $this->viewModel->set("departmentName",ucfirst($name));
        }

    }

    public function departmentDelete($id){
        try
        {
            $sql = 'DELETE FROM department WHERE id = :id';
            $s = $this->database->prepare($sql);
            $s->bindValue(':id', $id);
            $s->execute();
            return $id;
        }
        catch (PDOException $e)
        {
            $error = 'Error adding department: '.$e->getMessage();
            $this->viewModel->set("dbError",$error);
        }
    }

    public function departmentUpdate($id,$name)
    {
        try
        {
            $sql = 'UPDATE department SET name = :name WHERE id = :id';
            $s = $this->database->prepare($sql);
            $s->bindValue(':name',$name);
            $s->bindValue(':id',$id);
            $s->execute();
            return $id;
        }
        catch (PDOException $e)
        {
            $error = 'Error adding department: '.$e->getMessage();
            $this->viewModel->set("dbError",$error);
            $this->viewModel->set("departmentName",$name);
        }

    }



}