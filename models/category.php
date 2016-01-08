<?php
/*
 * Project: ODDS & ENDS
 * File: /models/categoy.php
 * Purpose: model for the client controller.
 * Author: Robert Dziuba & Inga Schwarze
 */

class CategoryModel extends BaseModel
{

    /**
     * CategoryModel constructor.
     */
    public function __construct()
    {

        parent::__construct();

        $this->viewModel->set("javascripts", array("backend.js","category.js"));
    }

    //data passed to the home index view
    public function index()
    {
        $this->viewModel->set("pageTitle", "Category - ODDS&amp;ENDS");
        //Modals
        $this->viewModel->set("modals", array("Category/categoryFormModal.php"));
        return $this->viewModel;
    }

    public function getAllCategories()
    {
        try {
            $sql = 'SELECT * FROM category';
            $s = $this->database->prepare($sql);
            $s->execute();
            $result = $this->tableIdasArrayKey($s->fetchAll(PDO::FETCH_ASSOC));
            $this->viewModel->set("categories", $result);
        } catch (PDOException $e) {
            $this->setError('Error getting departments: '.$e->getMessage());
        }
    }

    public function getCategory($id)
    {
        try
        {
            $sql = 'SELECT * FROM category WHERE id = :id';
            $s = $this->database->prepare($sql);
            $s->bindValue(':id', $id);
            $s->execute();
            $result = $this->tableIdasArrayKey($s->fetchAll(PDO::FETCH_ASSOC));
            if(!empty($result)){
                $this->viewModel->set("category", $result[$id]);
            }else {
                $this->setError('Category with id '.$id.' not found!');
            }
        }
        catch (PDOException $e)
        {
            $this->setError('Error getting category: '.$e->getMessage());
        }
    }

    public function updateModel($errors = null){
        if($errors != null) {
            $this->setError("validateError", $errors);
        }

        $this->viewModel->set("pageTitle", "update Category - ODDS&amp;ENDS");
        return $this->viewModel;
    }

    public function updateCategory($data){
        try
        {
            $sql = 'UPDATE category SET
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
            $this->setError('Error updating category: '.$e->getMessage());
        }
    }

    public function deleteCategory($data){
        try
        {
            $sql = 'Delete FROM category WHERE id = :id';
            $s = $this->database->prepare($sql);
            $s->bindValue(':id', $data->id);
            $s->execute();
            return $s->rowCount();
        }
        catch (PDOException $e)
        {
            $this->setError('Error deleting category: '.$e->getMessage());
        }
    }

    public function newCategory()
    {
        $this->viewModel->set("pageTitle","New Category - ODDS&amp;ENDS");
        return $this->viewModel;
    }

    public function creatNewCategory($data){
        try
        {
            $sql = 'INSERT INTO category SET
                    name = :name,
                    updated_at = now(),
                    created_at = now()';
            $s = $this->database->prepare($sql);
            $s->bindValue(':name', $data->name);
            $s->execute();

            return $this->database->lastInsertId();
        }
        catch (PDOException $e)
        {
            $this->setError('Error adding category: '.$e->getMessage());
        }

        return $this->viewModel;
    }

    public function ajaxMSG($msg)
    {
        $this->viewModel->set("msg", $msg);
        return $this->viewModel;
    }
}