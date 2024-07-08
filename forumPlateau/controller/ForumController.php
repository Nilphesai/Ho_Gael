<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

class ForumController extends AbstractController implements ControllerInterface{

    public function index() {
        
        return [
            "view" => VIEW_DIR."home.php",
            "meta_description" => "page d'acceuil"
        ];
    }

    public function listCategories(){
        // créer une nouvelle instance de CategoryManager
        $categoryManager = new CategoryManager();
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $categories = $categoryManager->findAll(["id_category", ""]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR."forum/listCategories.php",
            "meta_description" => "Liste des catégories du forum",
            "data" => [
                "categories" => $categories
            ]
        ];
    }

    public function addCategory(){
        $categoryManager = new CategoryManager();
        $newCategory = [];
        $newCategory['name'] = $_POST['name'];
        //var_dump($newTopic);die;
        $categoryManager->add($newCategory);

        $categories = $categoryManager->findAll(["id_category", ""]);
        return ["view" => VIEW_DIR."forum/listCategories.php",
            "meta_description" => "Liste des catégories du forum",
            "data" => [
                "categories" => $categories
            ]

    ];
    }
    
    public function addTopic(){
        $topicManager = new TopicManager();
        $newTopic = [];
        $newTopic['title'] = $_POST['title'];
        $newTopic['category_id'] = $_GET['id'];
        $newTopic['user_id'] = $_SESSION['user']->getid();
        //var_dump($newTopic);die;
        $topicManager->add($newTopic);
        $theNewTopic = $topicManager->findTopic($_POST['title'], $_SESSION['user']->getid(), $_GET['id']);
        
        $postManager = new PostManager();
        
        $newPost = [];
        $newPost['text'] = $_POST['text'];
        $newPost['topic_id'] = $theNewTopic->getId();
        $newPost['user_id'] = $_SESSION['user']->getid();
        $postManager->add($newPost);

        $categoryManager = new CategoryManager();
        $category = $categoryManager->findOneById($_GET['id']);
        $topics = $topicManager->findTopicsByCategory($_GET['id']);
        return ["view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => " : ",
            "data" => [
                "category" => $category,
                "topics" => $topics
            ]

    ];
    }

    public function addPost(){

        $postManager = new PostManager();
        
        $newPost = [];
        $newPost['text'] = $_POST['text'];
        $newPost['topic_id'] = $_GET['id'];
        $newPost['user_id'] = $_SESSION['user']->getid();
        $postManager->add($newPost);

        $posts = $postManager->findPostsByTopic($_GET['id']);
        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($_GET['id']);
        
        return ["view" => VIEW_DIR."forum/listPosts.php",
            "meta_description" => "messages : ",
            "data" => [
                "topic" => $topic,
                "posts" => $posts
            ]
        ];
    }

    public function listTopicsByCategory($id) {

        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();

        $listCategories = $categoryManager->findAll(["id_category", ""]);
        $category = $categoryManager->findOneById($id);
        $topics = $topicManager->findTopicsByCategory($id);

        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Liste des topics par catégorie : ".$category,
            "data" => [
                "listCategories" => $listCategories,
                "category" => $category,
                "topics" => $topics
            ]
        ];
    }

    public function listPostsByTopics($id) {

        $postManager = new PostManager();
        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);
        $posts = $postManager->findPostsByTopic($id);

        return [
            "view" => VIEW_DIR."forum/listPosts.php",
            "meta_description" => "Liste des Posts par topic : ".$topic,
            "data" => [
                "topic" => $topic,
                "posts" => $posts
            ]
        ];
    }


}