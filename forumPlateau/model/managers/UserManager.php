<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class UserManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\User";
    protected $tableName = "user";

    public function __construct(){
        parent::connect();
    }

    // récupérer tous les topics d'une catégorie spécifique (par son id)
    public function addUser() {

        $sql = "INSERT INTO ".$this->tableName." (nickName, password, email)
                VALUES (".$_POST['nickName'].", ".$_POST['password'].", ".$_POST['email'].")";
       
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::INSERT($sql), 
            $this->className
        );
    }
}