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
            SELECT personne.nom, personne.prenom, role.nom
            FROM acteur
            INNER JOIN jouer ON jouer.id_acteur = acteur.id_acteur
            JOIN role ON role.id_role = jouer.id_role
            JOIN personne ON personne.id_personne = acteur.id_personne
            WHERE jouer.id_film = :id
        ");
        $requeteRealisateur->execute(["id" => $id]);

        $requeteGenre = $pdo->prepare("
            SELECT libelle
            FROM genre
            INNER JOIN categoriser ON categoriser.id_genre = genre.id_genre
            WHERE categoriser.id_film = :id
        ");
        $requeteGenre->execute( ["id" => $id]);

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

    public Function detailActeur($id){

        $pdo = Connect::seConnecter();
        $requeteActeur = $pdo->prepare("
            SELECT nom, prenom, sexe, DATE_FORMAT(date_naissance,'%d %M %Y') AS dateNaissance
            FROM personne
            INNER JOIN acteur ON personne.id_personne = acteur.id_personne
            WHERE acteur.id_acteur = :id
        ");
        $requeteActeur->execute(["id" => $id]);

        $requeteCasting = $pdo->prepare("
        SELECT film.titre, role.nom
        FROM acteur
        INNER JOIN jouer ON jouer.id_acteur = acteur.id_acteur
        JOIN role ON role.id_role = jouer.id_role
        JOIN personne ON personne.id_personne = acteur.id_personne
        JOIN film ON film.id_film = jouer.id_film
        WHERE jouer.id_acteur = :id
        ");
        $requeteCasting->execute( ["id" => $id]);

        require "view/detailActeur.php";

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

    public Function detailRealisateur($id){

        $pdo = Connect::seConnecter();
        $requeteRealisateur = $pdo->prepare("
            SELECT nom, prenom, sexe, DATE_FORMAT(date_naissance,'%d %M %Y') AS dateNaissance
            FROM personne
            INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
            WHERE realisateur.id_realisateur = :id
        ");
        $requeteRealisateur->execute(["id" => $id]);

        $requeteFilmographie = $pdo->prepare("
        SELECT titre
        FROM Realisateur
        INNER JOIN film ON film.id_realisateur = realisateur.id_realisateur
        WHERE realisateur.id_realisateur = :id
        ");
        $requeteFilmographie->execute( ["id" => $id]);

        require "view/detailRealisateur.php";

    }

    
}