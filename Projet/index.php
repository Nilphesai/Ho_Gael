<?php

use controller\CardsController;

spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

$ctrlCards = new CardsController();

$id = (isset($_GET["id"])) ? $_GET["id"] : null;
//$type = (isset($_GET["type"])) ? $_GET["type"] : null;

if(isset($_GET["action"])){
    switch ($_GET["action"]){

        case "listCards" : $ctrlCards->listCards(); break;
        case "detailCard" : $ctrlCards->detailCard($id); break;

    }
}