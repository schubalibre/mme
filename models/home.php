<?php
/* 
 * Project: ODDS & ENDS
 * File: /models/home.php
 * Purpose: model for the home controller.
 * Author: Robert Dziuba & Inga Schwarze
 */

class HomeModel extends BaseModel
{
    /**
     * HomeModel constructor.
     */
    public function __construct()
    {

        parent::__construct();

        $this->viewModel->set("mainMenu",array(
                "home" => "#home",
                "räume" => "#rooms",
                "artikel" => "#articles",
                "login" => "/backend/login")
        );

        $this->viewModel->set("modals", array("home.php"));
        $this->viewModel->set("javascripts", array("vendor/jquery.lazylinepainter-1.7.0.js","home.js"));
        $this->viewModel->set("slider","Home/slider.php");
        $this->viewModel->set("modals", array("Home/loginModal.php","Home/productModal.php"));
    }

    //data passed to the home index view
    public function index()
    {
        $this->viewModel->set("site","home");
        $this->viewModel->set("pageTitle","Home - ODDS&amp;ENDS");

        // wir holen uns alle departments aus dem department Model
        require_once "room.php";

        $room = new RoomModel();

        $room->getAllRooms();

        $this->viewModel->set("rooms", $room->viewModel->rooms);

        $this->getActiveDepartments();

        // wir holen uns alle departments aus dem department Model
        require_once "article.php";

        $room = new ArticleModel();

        $room->getAllArticles();

        $this->viewModel->set("articles", $room->viewModel->articles);

        $this->getActiveCategories();

        return $this->viewModel;
    }

    public function getActiveDepartments()
    {
        try
        {
            $sql = 'SELECT d.id, d.name FROM room r, department d WHERE r.department_id = d.id ORDER BY d.name';
            $s = $this->database->prepare($sql);
            $s->execute();
            $result = $this->tableIdAsArrayKey($s->fetchAll(PDO::FETCH_ASSOC));
            $this->viewModel->set("activeDepartments", $result);
        } catch (PDOException $e) {
            $this->setError('DatabaseError','Error getting active departments: '.$e->getMessage());
        }

        return $this->viewModel;
    }

    public function getActiveCategories()
    {
        try
        {
            $sql = 'SELECT c.id, c.name FROM article a, category c WHERE a.category_id = c.id ORDER BY c.name';
            $s = $this->database->prepare($sql);
            $s->execute();
            $result = $this->tableIdAsArrayKey($s->fetchAll(PDO::FETCH_ASSOC));
            $this->viewModel->set("activeCategories", $result);
        } catch (PDOException $e) {
            $this->setError('DatabaseError','Error getting active categories: '.$e->getMessage());
        }

        return $this->viewModel;
    }

    public function getRoom($id){
        // wir holen uns alle departments aus dem department Model
        require_once "room.php";

        $room = new RoomModel();

        $room->getRoom($id);

        $room = $room->viewModel->room;

        require_once "article.php";

        $article = new ArticleModel();

        $article->getAllArticlesFromRoom($id);

        $room['articles'] = $article->viewModel->articles;

        $this->viewModel->set("room", $room);

        return $this->viewModel;
    }

    public function getArticle($id){
        // wir holen uns alle departments aus dem department Model
        require_once "article.php";

        $room = new ArticleModel();

        $room->getArticle($id);

        $article = $room->viewModel->article;

        // wir holen uns alle departments aus dem department Model
        require_once "room.php";

        $room = new RoomModel();

        $room->getRoom($article['room_id']);

        $article['room'] = $room->viewModel->room;

        $this->viewModel->set("article", $article);

        return $this->viewModel;
    }

    public function staticPage($string)
    {

        $this->viewModel->set("mainMenu",array(
                "home" => "/#home",
                "rooms" => "/#rooms",
                "articles" => "/#articles",
                "login" => "/backend/login")
        );

        $this->viewModel->set("pageTitle",ucfirst($string)." - ODDS&amp;ENDS");
        return $this->viewModel;
    }
}

?>
