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
        if (isset($_POST["submit"])){
            $categoryManager->add($newCategory);
        }
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
        
        //var_dump($newTopic);die;
        if (isset($_POST["submit"])){
            $newTopic = [];
            $newTopic['title'] = $_POST['title'];
            $newTopic['category_id'] = $_GET['id'];
            $newTopic['user_id'] = $_SESSION['user']->getid();
            $topicManager->add($newTopic);

            $theNewTopic = $topicManager->findTopic($_POST['title'], $_SESSION['user']->getid(), $_GET['id']);
        
            $postManager = new PostManager();
            
            $newPost = [];
            $newPost['text'] = $_POST['text'];
            $newPost['topic_id'] = $theNewTopic->getId();
            $newPost['user_id'] = $_SESSION['user']->getid();
            $postManager->add($newPost);
        }
        
        $categoryManager = new CategoryManager();
        $listCategories = $categoryManager->findAll();
        $category = $categoryManager->findOneById($_GET['id']);
        $topics = $topicManager->findTopicsByCategory($_GET['id']);
        return ["view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => " : ",
            "data" => [
                "listCategories" => $listCategories,
                "category" => $category,
                "topics" => $topics
            ]

    ];
    }

    public function addPost(){

        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($_GET['id']);
        $postManager = new PostManager();
        //var_dump($_POST);
        if (isset($_POST["submit"]) && $topic->getClosed() == 0){
            
            $newPost = [];
            $newPost['text'] = $_POST['text'];
            $newPost['topic_id'] = $_GET['id'];
            $newPost['user_id'] = $_SESSION['user']->getid();
            $postManager->add($newPost);
            
            
        }
        
        $posts = $postManager->findPostsByTopic($_GET['id']);
        return ["view" => VIEW_DIR."forum/listPosts.php",
                "meta_description" => "messages : ",
                "data" => [
                    "topic" => $topic,
                    "posts" => $posts
                ]
            ];
    }

    public function moveTopic(){
        $topicManager = new TopicManager();
        
        //var_dump($newTopic);die;
        if (isset($_POST["submit"])){
            $newTopic = [];
            
            $moveIn['category_id'] = $_POST['category'];
            //var_dump($_POST);die;
            $topicManager->modify($moveIn,$_GET['id']);
        }
        
        $categoryManager = new CategoryManager();
        $listCategories = $categoryManager->findAll();
        $category = $categoryManager->findOneById($_POST['category']);
        $topics = $topicManager->findTopicsByCategory($_POST['category']);
        return ["view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => " : ",
            "data" => [
                "listCategories" => $listCategories,
                "category" => $category,
                "topics" => $topics
            ]

    ];
    }

    public function deleteCategory(){
        $categoryManager = new CategoryManager();
        $topicManager = new TopicManager();
        $topics = $topicManager->findTopicsByCategory($_GET['id']);
        if (!isset($topics)){
            $categoryManager->delete($_GET['id']);
        }
        else{
            $categories = $categoryManager->findAll(["id_category", ""]);
            return ["view" => VIEW_DIR."forum/listCategories.php",
                "meta_description" => "Liste des catégories du forum",
                "data" => [
                "categories" => $categories
            ]

            ];
        }
        $categories = $categoryManager->findAll(["id_category", ""]);
        return ["view" => VIEW_DIR."forum/listCategories.php",
                "meta_description" => "Liste des catégories du forum",
                "data" => [
                "categories" => $categories
            ]

        ];

    }

    public function deleteTopics(){
        $topicManager = new TopicManager();
        $postManager = new PostManager();
        //var_dump($_GET['id']);die;
        $posts = $postManager->findPostsByTopic($_GET['id']);
        $tab=[];
        foreach($posts as $post){
            //var_dump($post);die;
            $tab["id"] = $post->getId();
            $postManager->delete($tab['id']);
        }
        $topicManager->delete($_GET['id']);
        
        return [
            "view" => VIEW_DIR."home.php",
            "meta_description" => "page d'acceuil"
        ];

    }

    public function deletePost(){
        $topicManager = new TopicManager();
        $postManager = new PostManager();
        
        //var_dump($_GET['id']);die;
        $post = $postManager->findOneById($_GET['id']);
        $tab['id']= $post->getId();
        $tab['topic']= $post->getTopic();
        //var_dump($tab['id']);die;
        $postManager->delete($tab['id']);
        $topic = $topicManager->findOneById($tab['topic']);
        $posts = $postManager->findPostsByTopic($tab['topic']);
        return [
            "view" => VIEW_DIR."home.php",
            "meta_description" => "page d'acceuil"
        ];
    }

    public function listTopicsByCategory($id) {

        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();

        $listCategories = $categoryManager->findAll();
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

    public function lockTopic(){
        
        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($_GET['id']);

        $switchPost = [];
        if ($topic->getClosed() == 1){
            $switchPost['closed'] = 0;
        } else{
            $switchPost['closed'] = 1;
        }
        //var_dump($switchPost);die;

        $topicManager->modify($switchPost,$_GET['id']);

        $postManager = new PostManager();
        $topic = $topicManager->findOneById($_GET['id']);
        $posts = $postManager->findPostsByTopic($_GET['id']);

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