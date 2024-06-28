<?php

namespace Controller;
use Model\Connect;

class CinemaController {

    /**
     * Lister les films
     */
    public Function listFilms(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT titre, annee_sortie
            FROM film
        ");

        require "view/listFilms.php";
    }

    public Function detailFilm($id){

        $pdo = Connect::seConnecter();
        $requeteFilm = $pdo->prepare("
            SELECT *
            FROM film
            WHERE id_film = :id
        ");
        $requeteFilm->execute(["id" => $id]);

        $requeteRealisateur = $pdo->prepare("
            SELECT personne.nom, personne.prenom
            FROM personne
            INNER JOIN realisateur ON realisateur.id_personne = personne.id_personne
            JOIN film ON film.id_realisateur = realisateur.id_realisateur
            WHERE film.id_film = :id
        ");
        $requeteRealisateur->execute(["id" => $id]);

        $requeteCasting = $pdo->prepare("
        SELECT personne.nom, personne.prenom, role.nom
        FROM acteur
        INNER JOIN jouer ON jouer.id_acteur = acteur.id_acteur
        JOIN role ON role.id_role = jouer.id_role
        JOIN personne ON personne.id_personne = acteur.id_personne
        WHERE jouer.id_film = :id
        ");
        $requeteCasting->execute( ["id" => $id]);

        require "view/detailFilm.php";
    }

    public Function listActeurs(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT prenom, nom
            FROM personne
            INNER JOIN acteur ON personne.id_personne = acteur.id_personne
        ");

        require "view/listActeurs.php";
    }

    public Function listRealisateurs(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT prenom, nom
            FROM personne
            INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
        ");

        require "view/listRealisateurs.php";
    }

    
}