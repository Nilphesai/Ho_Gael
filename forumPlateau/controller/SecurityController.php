<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register () {

    
    //$user = $usersManager->findAll(["nickname", "password", "email", "DESC"]);

    // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
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