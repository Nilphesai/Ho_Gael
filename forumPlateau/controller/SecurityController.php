<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register () {
        $tab = [];

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
    ];
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