<?php
/*
 * Project: ODDS & ENDS
 * File: /models/categoy.php
 * Purpose: model for the client controller.
 * Author: Robert Dziuba & Inga Schwarze
 */

class ArticleModel extends BaseModel
{
    private $error = [];
    
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

        //Modals
        $this->viewModel->set("modals", array("Article/articleFormModal.php"));

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
            $this->setError('Error getting departments: '.$e->getMessage());
        }

        return $this->viewModel;
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
                $this->setError('Article with id '.$id.' not found!');
            }
        }
        catch (PDOException $e)
        {
            $this->setError('Error getting article: '.$e->getMessage());
        }

        return $this->viewModel;
    }

    public function updateModel($errors = null){
        if($errors != null) {
            $this->setError("validateError", $errors);
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
            $this->setError('Error updating article: '.$e->getMessage());
        }

        return $this->viewModel;
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
            $this->setError('Error deleting article: '.$e->getMessage());
        }

        return $this->viewModel;
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
                    updated_on = now(),
                    created_on = now()';
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
            $this->setError('Error adding article: '.$e->getMessage());
            $this->viewModel->set("article",(array) $data);
        }
    }
    
    public function deleteImagesFromDisk($data)
    {
        $data = $this->getArticle($data->id);

        $image = $data->article['img'];

        $path = "images/";
        $pathThumbnail = "images/thumbnails/";

        if (file_exists($path.$image)) {
            unlink($path.$image);
        } else {
            $this->setError('Could not delete '.$path.$image.', file does not exist');
        }

        if (file_exists($pathThumbnail."thumb_" . $image)) {
            unlink($pathThumbnail."thumb_" . $image);
        } else {
            $this->setError('Could not delete '.$pathThumbnail."thumb_" . $image.', file does not exist');
        }

        return true;
    }
    
    public function getAllArticles()
    {
        try {
            $sql = 'SELECT * FROM article';
            $s = $this->database->prepare($sql);
            $s->execute();
            $result = $this->tableIdasArrayKey($s->fetchAll(PDO::FETCH_ASSOC));
            $this->viewModel->set("articles", $result);
        } catch (PDOException $e) {
            $this->setError('Error getting rooms: '.$e->getMessage());
        }

        return $this->viewModel;
    }

    public function getAllArticlesFromRoom($room_id)
    {
        try {
            $sql = 'SELECT * FROM article WHERE room_id = :room_id';
            $s = $this->database->prepare($sql);
            $s->bindValue(':room_id', $room_id);
            $s->execute();
            $result = $this->tableIdasArrayKey($s->fetchAll(PDO::FETCH_ASSOC));
            $this->viewModel->set("articles", $result);
        } catch (PDOException $e) {
            $this->setError('Error getting rooms: '.$e->getMessage());
        }

        return $this->viewModel;
    }
}