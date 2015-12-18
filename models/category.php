<?php
/*
 * Project: ODDS & ENDS
 * File: /models/categoy.php
 * Purpose: model for the client controller.
 * Author: Robert Dziuba & Inga Schwarze
 */

class CategoryModel extends BaseModel
{
    //data passed to the home index view
    public function index()
    {
        $this->viewModel->set("pageTitle", "Category - ODDS&amp;ENDS");

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
            $error = 'Error getting departments: '.$e->getMessage();
            $this->viewModel->set("dbError", $error);
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
                $error[] = 'Category with id '.$id.' not found!';
                $this->viewModel->set("errors", $error);
            }
        }
        catch (PDOException $e)
        {
            $error[] = 'Error getting category: '.$e->getMessage();
            $this->viewModel->set("errors",$error);
        }
    }

    public function updateModel($errors = null){
        if($errors != null) {
            $this->viewModel->set("validateError", $errors);
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
            $error[] = 'Error updating category: '.$e->getMessage();
            $this->viewModel->set("errors",$error);
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
            $error[] = 'Error deleting category: '.$e->getMessage();
            $this->viewModel->set("errors",$error);
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
            $error[] = 'Error adding category: '.$e->getMessage();
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