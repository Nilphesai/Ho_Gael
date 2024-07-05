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

    public function findUser($nickName, $email){

        $sql = "SELECT *
                FROM ".$this->tableName." a
                WHERE a.nickName = :nickName OR a.email = :email
                ";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['nickName' => $nickName, 'email' => $email], false), 
            $this->className
        );
    }
}