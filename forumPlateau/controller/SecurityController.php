<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use App\Session;
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
                // créer une nouvelle instance de UserManager
                $userManager = new UserManager();
                // chercher si User existe déjà
                $users = $userManager->findUser($nickName,$email);
                
                    if($users){
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

         

        return [
        "view" => VIEW_DIR."security/register.php",
        "meta_description" => "entré incorrecte",
        "data" => []
        ];    
    }

    public function login () {
        if(isset($_POST["submit"])){
        
            $nickName = filter_input(INPUT_POST, "nickName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            if($nickName && $password){
                // créer une nouvelle instance de UserManager
                $userManager = new UserManager();
                // récupérer la liste des User grâce à la méthode findAll de Manager.php (triés par nom)
                $users = $userManager->findUser($nickName, "");

                    if($users){
                        $hash = $users->getPassword();
                        if(password_verify($password, $hash)){
                            $session = new Session();
                            $session->setUser($users);
                            return [
                                "view" => VIEW_DIR."home.php",
                                "meta_description" => "session ouverte",
                                "data" => []
                                ];    
                        } else {
                            return [
                                "view" => VIEW_DIR."security/login.php",
                                "meta_description" => "mot de passe incorrecte",
                                "data" => []
                                ];    
                        }
                    } else {
                        return [
                            "view" => VIEW_DIR."security/login.php",
                            "meta_description" => "utilisateur introuvable",
                            "data" => []
                            ]; 
                    }
            }

            
        }
        return [
            "view" => VIEW_DIR."security/login.php",
            "meta_description" => "entré",
            "data" => []
            ];    
    }

    public function logout () {

        unset($_SESSION["user"]);
        
        return [
            "view" => VIEW_DIR."home.php",
            "meta_description" => "session ouverte",
            "data" => []
            ];
    }
}