<?php

namespace Controller;
use Model\Connect;

class CardsController {

    /**
     * Lister les cartes
     */
    public Function listCards(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT *
            FROM cards
            ORDER BY id_card
        ");

        require "view/listCards.php";
    }

    public Function detailCard($id){

        $pdo = Connect::seConnecter();
        $requeteCard = $pdo->prepare("
            SELECT *
            FROM Cards
            WHERE id_card = :id
        ");
        $requeteCard->execute(["id" => $id]);

        require "view/detailCard.php";
    }

}