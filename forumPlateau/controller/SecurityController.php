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
            foreach ($_POST as $key => $value){
                $tab[$key] = $value;
            
            }
            unset($tab['submit']);
            $userManager = new UserManager();
            $user = $userManager->add($tab);
        }
    
    return [
        "view" => VIEW_DIR."security/register.php",
        "meta_description" => "inscription au forum",
        "data" => []
    ];
    }

    public function login () {
        
    }

    public function logout () {}
}