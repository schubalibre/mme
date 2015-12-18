<?php
/*
 * Project: ODDS & ENDS
 * File: /models/client.php
 * Purpose: model for the client controller.
 * Author: Robert Dziuba & Inga Schwarze
 */

class ClientModel extends BaseModel
{
    //data passed to the home index view
    public function index()
    {
        $this->viewModel->set("pageTitle","Client - ODDS&amp;ENDS");
        return $this->viewModel;
    }

    public function getAllClients(){
        try {
            $sql = 'SELECT * FROM client';
            $s = $this->database->prepare($sql);
            $s->execute();
            $result = $this->tableIdasArrayKey($s->fetchAll(PDO::FETCH_ASSOC));
            $this->viewModel->set("clients", $result);
        } catch (PDOException $e) {
            $error = 'Error getting clients: '.$e->getMessage();
            $this->viewModel->set("dbError", $error);
        }
    }

    public function newModel($errors = null)
    {
        if($errors != null) {
            $this->viewModel->set("validateError", $errors);
        }

        $this->viewModel->set("pageTitle","New Client - ODDS&amp;ENDS");
        return $this->viewModel;
    }

    public function insertClient($data)
    {
        try
        {
            $sql = 'INSERT INTO client SET
                    name = :name,
                    lastname = :lastname,
                    email = :email,
                    password = MD5(:password),
                    updated_at = now(),
                    created_at = now()';
            $s = $this->database->prepare($sql);
            $s->bindValue(':name', $data->name);
            $s->bindValue(':lastname', $data->lastname);
            $s->bindValue(':email', $data->email);
            $s->bindValue(':password', $data->password); //optional, not required
            $s->execute();

            return $this->database->lastInsertId();
        }
        catch (PDOException $e)
        {
            $error[] = 'Error adding client: '.$e->getMessage();
            $this->viewModel->set("errors",$error);
        }
    }

    public function getClient($id){

        try
        {
            $sql = 'SELECT * FROM client WHERE id = :id';
            $s = $this->database->prepare($sql);
            $s->bindValue(':id', $id);
            $s->execute();
            $result = $this->tableIdasArrayKey($s->fetchAll(PDO::FETCH_ASSOC));
            if(!empty($result)){
                $this->viewModel->set("client", $result[0]);
            }else {
                $error[] = 'Client with id '.$id.' not found!';
                $this->viewModel->set("errors", $error);
            }
        }
        catch (PDOException $e)
        {
            $error[] = 'Error getting client: '.$e->getMessage();
            $this->viewModel->set("errors",$error);
        }
    }

    public function updateModel($errors = null)
    {

        if($errors != null) {
            $this->viewModel->set("validateError", $errors);
        }

        $this->viewModel->set("pageTitle", "update Client - ODDS&amp;ENDS");
        return $this->viewModel;
    }

    public function updateClient($data){
        //reset password if empty
        $data->password = $data->password != "" ? $data->password : null;
        try
        {
            $sql = 'UPDATE client SET
                    name = :name,
                    lastname = :lastname,
                    email = :email,
                    password = COALESCE(NULLIF(MD5(:password), ""), password),
                    updated_at = now()
                    WHERE id = :id';
            $s = $this->database->prepare($sql);
            $s->bindValue(':name', $data->name);
            $s->bindValue(':lastname', $data->lastname);
            $s->bindValue(':email', $data->email);
            $s->bindValue(':password', $data->password);
            $s->bindValue(':id', $data->id);
            $s->execute();
            return $s->rowCount();
        }
        catch (PDOException $e)
        {
            $error[] = 'Error getting client: '.$e->getMessage();
            $this->viewModel->set("errors",$error);
        }
    }

    public function deleteClient($data){

        try
        {
            $sql = 'Delete FROM client WHERE id = :id';
            $s = $this->database->prepare($sql);
            $s->bindValue(':id', $data->id);
            $s->execute();
            return $s->rowCount();
        }
        catch (PDOException $e)
        {
            $error[] = 'Error getting client: '.$e->getMessage();
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

?>