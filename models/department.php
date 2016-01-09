<?php
/**
 * Created by PhpStorm.
 * User: roberto
 * Date: 17/12/15
 * Time: 21:42
 */

class DepartmentModel extends BaseModel
{
    /**
     * DepartmentModel constructor.
     */
    public function __construct()
    {

        parent::__construct();

        $this->viewModel->set("javascripts", array("backend.js","department.js"));
    }


    //data passed to the home index view
    public function index()
    {
        $this->viewModel->set("pageTitle", "Department - ODDS&amp;ENDS");
        //Modals
        $this->viewModel->set("modals", array("Department/departmentFormModal.php"));
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
            $this->setError('Error getting departments: '.$e->getMessage());
        }
    }

    public function newModel($errors = null)
    {

        if($errors != null) {
            $this->setError("validateError", $errors);
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
            $this->setError('Error adding client: '.$e->getMessage());
        }

        return $this->viewModel;
    }

    public function updateModel($errors = null)
    {

        if($errors != null) {
            $this->setError("validateError", $errors);
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
            $this->setError('Error updating department: '.$e->getMessage());
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
            $result = $s->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($result)){
                $this->viewModel->set("department", $result[0]);
            }else {
                $this->setError('Department with id '.$id.' not found!');
            }
        }
        catch (PDOException $e)
        {
            $this->setError('Error getting category: '.$e->getMessage());
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
            $this->setError('Error deleting department: '.$e->getMessage());
        }
    }

    public function ajaxMSG($msg)
    {
        $this->viewModel->set("msg", $msg);
        return $this->viewModel;
    }
}