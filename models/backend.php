<?php
/*
 * Project: ODDS & ENDS
 * File: /models/categoy.php
 * Purpose: model for the client controller.
 * Author: Robert Dziuba & Inga Schwarze
 */

class BackendModel extends BaseModel
{
    //data passed to the home index view
    public function index()
    {
        $this->viewModel->set("pageTitle", "Backend - ODDS&amp;ENDS");

        return $this->viewModel;
    }

    //data passed to the home index view
    public function login($errors = null)
    {

        if($errors != null) {
            $this->setError("validateError", $errors);
        }

        $this->viewModel->set("pageTitle", "LOGIN - ODDS&amp;ENDS");

        return $this->viewModel;
    }

    public function makeLogin($data){
        try
        {
            $sql = 'SELECT * FROM client WHERE email = :email AND password = MD5(:password) LIMIT 0,1';
            $s = $this->database->prepare($sql);
            $s->bindValue(':email', $data->email);
            $s->bindValue(':password', $data->password);
            $s->execute();
            $result = $s->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($result)){
                return $result;
            }else {
                $error[] = 'Client with email '.$data->email.' or Password not found!';
                $this->viewModel->set("errors", $error);
            }
        }
        catch (PDOException $e)
        {
            $error[] = 'Error getting Client: '.$e->getMessage();
            $this->viewModel->set("errors",$error);
        }
    }

    public function LoginOk($data){
        $this->viewModel->set("client",$data);
        return $this->viewModel;
    }
}