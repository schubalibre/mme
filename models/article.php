<?php
/*
 * Project: ODDS & ENDS
 * File: /models/categoy.php
 * Purpose: model for the client controller.
 * Author: Robert Dziuba & Inga Schwarze
 */

class ArticleModel extends BaseModel
{
    //data passed to the home index view
    public function index()
    {
        // wir holen uns alle departments aus dem department Model
        require_once "category.php";

        $department = new CategoryModel();

        $department->getAllCategories();

        $this->viewModel->set("categories", $department->viewModel->categories);

        // wir holen uns alle Kunden aus dem client Model
        require_once "room.php";

        $department = new RoomModel();

        $department->getAllRooms();

        $this->viewModel->set("rooms", $department->viewModel->rooms);


        $this->viewModel->set("pageTitle", "Article - ODDS&amp;ENDS");

        return $this->viewModel;
    }

    public function getAllCategories()
    {
        try {
            $sql = 'SELECT * FROM article';
            $s = $this->database->prepare($sql);
            $s->execute();
            $result = $this->tableIdasArrayKey($s->fetchAll(PDO::FETCH_ASSOC));
            $this->viewModel->set("articles", $result);
        } catch (PDOException $e) {
            $error = 'Error getting departments: '.$e->getMessage();
            $this->viewModel->set("dbError", $error);
        }
    }

    public function getArticle($id)
    {
        try
        {
            $sql = 'SELECT * FROM article WHERE id = :id';
            $s = $this->database->prepare($sql);
            $s->bindValue(':id', $id);
            $s->execute();
            $result = $this->tableIdasArrayKey($s->fetchAll(PDO::FETCH_ASSOC));
            if(!empty($result)){
                $this->viewModel->set("article", $result[$id]);
            }else {
                $error[] = 'Article with id '.$id.' not found!';
                $this->viewModel->set("errors", $error);
            }
        }
        catch (PDOException $e)
        {
            $error[] = 'Error getting article: '.$e->getMessage();
            $this->viewModel->set("errors",$error);
        }
    }

    public function updateModel($errors = null){
        if($errors != null) {
            $this->viewModel->set("validateError", $errors);
        }

        // wir holen uns alle departments aus dem department Model
        require_once "category.php";

        $department = new CategoryModel();

        $department->getAllCategories();

        $this->viewModel->set("categories", $department->viewModel->categories);

        // wir holen uns alle Kunden aus dem client Model
        require_once "room.php";

        $department = new RoomModel();

        $department->getAllRooms();

        $this->viewModel->set("rooms", $department->viewModel->rooms);

        $this->viewModel->set("pageTitle", "update Article - ODDS&amp;ENDS");
        return $this->viewModel;
    }

    public function updateArticle($data){
        try
        {
            $sql = 'UPDATE article SET
                    room_id = :room_id,
                    category_id = :category_id,
                    name = :name,
                    title = :title,
                    description = :description,
                    img = :img,
                    shop = :shop,
                    website = :website,
                    updated_at = now()
                    WHERE id = :id';
            $s = $this->database->prepare($sql);
            $s->bindValue(':room_id', $data->room_id);
            $s->bindValue(':category_id', $data->category_id);
            $s->bindValue(':name', $data->name);
            $s->bindValue(':title', $data->title);
            $s->bindValue(':description', $data->description);
            $s->bindValue(':img', $data->img);
            $s->bindValue(':shop', $data->shop);
            $s->bindValue(':website', $data->website);
            $s->bindValue(':id', $data->id);
            $s->execute();
            return $s->rowCount();
        }
        catch (PDOException $e)
        {
            $error[] = 'Error updating article: '.$e->getMessage();
            $this->viewModel->set("errors",$error);
        }
    }

    public function deleteArticle($data){
        try
        {
            $sql = 'Delete FROM article WHERE id = :id';
            $s = $this->database->prepare($sql);
            $s->bindValue(':id', $data->id);
            $s->execute();
            return $s->rowCount();
        }
        catch (PDOException $e)
        {
            $error[] = 'Error deleting article: '.$e->getMessage();
            $this->viewModel->set("errors",$error);
        }
    }

    public function newArticle()
    {
        // wir holen uns alle departments aus dem department Model
        require_once "category.php";

        $department = new CategoryModel();

        $department->getAllCategories();

        $this->viewModel->set("categories", $department->viewModel->categories);

        // wir holen uns alle Kunden aus dem client Model
        require_once "room.php";

        $department = new RoomModel();

        $department->getAllRooms();

        $this->viewModel->set("rooms", $department->viewModel->rooms);

        $this->viewModel->set("pageTitle","New Article - ODDS&amp;ENDS");
        return $this->viewModel;
    }

    public function insertArticle($data){
        try
        {
            $sql = 'INSERT INTO article SET
                    room_id = :room_id,
                    category_id = :category_id,
                    name = :name,
                    title = :title,
                    description = :description,
                    img = :img,
                    shop = :shop,
                    website = :website,
                    updated_at = now(),
                    created_at = now()';
            $s = $this->database->prepare($sql);
            $s->bindValue(':room_id', $data->room_id);
            $s->bindValue(':category_id', $data->category_id);
            $s->bindValue(':name', $data->name);
            $s->bindValue(':title', $data->title);
            $s->bindValue(':description', $data->description);
            $s->bindValue(':img', $data->img);
            $s->bindValue(':shop', $data->shop);
            $s->bindValue(':website', $data->website);
            $s->execute();

            return $this->database->lastInsertId();
        }
        catch (PDOException $e)
        {
            $error[] = 'Error adding article: '.$e->getMessage();
            $this->viewModel->set("errors",$error);
            $this->viewModel->set("article",(array) $data);
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