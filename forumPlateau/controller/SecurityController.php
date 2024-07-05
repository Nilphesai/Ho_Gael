<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register () {
        $tab = [];
        if(isset($_POST["submit"])){
            $nickName = filter_input(INPUT_POST, "nickName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($nickName && $email && $password && $password2){
                // créer une nouvelle instance de CategoryManager
                $userManager = new UserManager();
                // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
                $users = $userManager->findAll(["nickName", "DESC"]);
                foreach ($users as $row){
                    //var_dump($row->getNickname());die;
                    
                    if($row->getNickname() == $nickName && $row->getEmail() == $email && $row->getPassword() == $password){
                        return [
                            "view" => VIEW_DIR."security/register.php",
                            "meta_description" => "déjà enregistré",
                            "data" => []
                        ];
                    }
                    else {
                        if($password == $password2 && strlen($password) >= 8){
                            $tab['nickname'] = $nickName;
                            $tab['password'] = password_hash($password, PASSWORD_DEFAULT);
                            $tab['email'] = $email;
                            $userManager = new UserManager();
                            $user = $userManager->add($tab);
                            return [
                                "view" => VIEW_DIR."home.php",
                                "meta_description" => "inscrit au forum",
                                "data" => []
                            ];
                        } else{
                            return [
                                "view" => VIEW_DIR."security/register.php",
                                "meta_description" => "mot de passe incorrect",
                                "data" => []
                            ];
                        }
                    }
                }
                
                } else{
                return [
                    "view" => VIEW_DIR."security/register.php",
                    "meta_description" => "champs de texte mal référencé",
                    "data" => []
                ];

            }

        } 

        return [
        "view" => VIEW_DIR."security/register.php",
        "meta_description" => "entré incorrecte",
        "data" => []
    ];
        /*
        $tab = [];
        var_dump($_POST);die;
        if(isset($_POST['nickName'])){
            $nickName = htmlspecialchars(filter_input(INPUT_POST, "nickName"));
            $password = htmlspecialchars(filter_input(INPUT_POST, "password"));
            $email = htmlspecialchars(filter_input(INPUT_POST, "email",FILTER_VALIDATE_EMAIL));
            
            if ($nickName && $password){
               
                $tab['nickname'] = $nickName;
                $tab['password'] = password_hash($password, PASSWORD_DEFAULT);
                $tab['email'] = $email;
                
                $userManager = new UserManager();
                $user = $userManager->add($tab);
            }
            
        }
    
    return [
        "view" => VIEW_DIR."security/register.php",
        "meta_description" => "inscription au forum",
        "data" => []
    ];*/
    }

    public function login () {
        /*public static function setUser($user){
            $_SESSION["user"] = $user;
        }*/

        
        $nickName = htmlspecialchars(filter_input(INPUT_POST, "nickName"));
        $password = htmlspecialchars(filter_input(INPUT_POST, "password"));
            
        if ($nickName && $password){

        }

        session();
        if(isset($_POST['nickName'])){
            
            unset($tab['submit']);
            $userManager = new UserManager();
            $user = $userManager->add($tab);
        }
    }

    public function logout () {}
}