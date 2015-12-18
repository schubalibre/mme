<?php
/**
 * Created by PhpStorm.
 * User: roberto
 * Date: 17/12/15
 * Time: 21:42
 */

class DepartmentModel extends BaseModel
{
    //data passed to the home index view
    public function index()
    {
        $this->viewModel->set("pageTitle", "Department - ODDS&amp;ENDS");
        return $this->viewModel;
    }

    public function getAllDepartments()
    {
        try {
            $sql = 'SELECT * FROM department';
            $s = $this->database->prepare($sql);
            $s->execute();
            $result = $this->tableIdasArrayKey($s->fetchAll(PDO::FETCH_ASSOC));
            $this->viewModel->set("departments", $result);
        } catch (PDOException $e) {
            $error = 'Error getting departments: '.$e->getMessage();
            $this->viewModel->set("dbError", $error);
        }
    }

    public function newModel($errors = null)
    {

        if($errors != null) {
            $this->viewModel->set("validateError", $errors);
        }

        $this->viewModel->set("pageTitle", "new Department - ODDS&amp;ENDS");
        return $this->viewModel;
    }

    public function insertDepartment($data)
    {
        try
        {
            $sql = 'INSERT INTO department SET
                    name = :name,
                    updated_at = now(),
                    created_at = now()';
            $s = $this->database->prepare($sql);
            $s->bindValue(':name', $data->name); //optional, not required
            $s->execute();

            return $this->database->lastInsertId();
        }
        catch (PDOException $e)
        {
            $error[] = 'Error adding client: '.$e->getMessage();
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

    public function updateDepartment($data)
    {
        try
        {
            $sql = 'UPDATE department SET
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
            $error[] = 'Error updating department: '.$e->getMessage();
            $this->viewModel->set("errors",$error);
        }
    }

    public function getDepartment($id)
    {
        try
        {
            $sql = 'SELECT * FROM department WHERE id = :id';
            $s = $this->database->prepare($sql);
            $s->bindValue(':id', $id);
            $s->execute();
            $result = $this->tableIdasArrayKey($s->fetchAll(PDO::FETCH_ASSOC));
            if(!empty($result)){
                $this->viewModel->set("department", $result[0]);
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

    public function deleteDepartment($data)
    {
        try
        {
            $sql = 'Delete FROM department WHERE id = :id';
            $s = $this->database->prepare($sql);
            $s->bindValue(':id', $data->id);
            $s->execute();
            return $s->rowCount();
        }
        catch (PDOException $e)
        {
            $error[] = 'Error deleting department: '.$e->getMessage();
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