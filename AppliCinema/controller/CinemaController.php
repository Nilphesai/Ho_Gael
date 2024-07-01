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
            SELECT id_film, titre, annee_sortie
            FROM film
            ORDER BY annee_sortie DESC
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
            SELECT personne.nom, personne.prenom, realisateur.id_realisateur
            FROM realisateur
            INNER JOIN personne ON personne.id_personne = realisateur.id_personne
            JOIN film ON film.id_realisateur = realisateur.id_realisateur
            WHERE film.id_film = :id
        ");
        $requeteRealisateur->execute(["id" => $id]);

        $requeteGenre = $pdo->prepare("
            SELECT libelle, genre.id_genre
            FROM genre
            INNER JOIN categoriser ON categoriser.id_genre = genre.id_genre
            WHERE categoriser.id_film = :id
        ");
        $requeteGenre->execute( ["id" => $id]);

        $requeteCasting = $pdo->prepare("
        SELECT personne.nom, personne.prenom, role.nom, acteur.id_acteur
        FROM acteur
        INNER JOIN jouer ON jouer.id_acteur = acteur.id_acteur
        JOIN role ON role.id_role = jouer.id_role
        JOIN personne ON personne.id_personne = acteur.id_personne
        WHERE jouer.id_film = :id
        ORDER BY personne.nom
        ");
        $requeteCasting->execute( ["id" => $id]);

        require "view/detailFilm.php";
    }

    public Function listFilmParGenre($id){

        $pdo = Connect::seConnecter();
        $requeteFilms = $pdo->prepare("
            SELECT film.titre, film.annee_sortie, film.id_film
            FROM film
            INNER JOIN categoriser ON film.id_film = categoriser.id_film
            JOIN genre ON categoriser.id_genre = genre.id_genre
            WHERE genre.id_genre = :id
            ORDER BY film.titre
        ");
        $requeteFilms->execute( ["id" => $id]);

        require "view/listFilmParGenre.php";
    }

    public Function listActeurs(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT id_acteur, prenom, nom
            FROM personne
            INNER JOIN acteur ON personne.id_personne = acteur.id_personne
            ORDER BY nom
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
        SELECT film.titre, film.annee_sortie, role.nom, film.id_film
        FROM acteur
        INNER JOIN jouer ON jouer.id_acteur = acteur.id_acteur
        JOIN role ON role.id_role = jouer.id_role
        JOIN personne ON personne.id_personne = acteur.id_personne
        JOIN film ON film.id_film = jouer.id_film
        WHERE jouer.id_acteur = :id
        ORDER BY film.annee_sortie
        ");
        $requeteCasting->execute( ["id" => $id]);

        require "view/detailActeur.php";

    }

    public Function addActeur(){
        $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $date_naissance = filter_input(INPUT_POST, "date_naissance");
        if($nom && $prenom && $sexe && $date_naissance){
            $pdo = Connect::seConnecter();  
            $sqlQuery2 = $pdo->prepare("
                SELECT id_personne
                FROM personne
                WHERE nom = :nomAdd AND prenom = :prenomAdd AND sexe = :sexeAdd AND date_naissance = :date_naissanceAdd");
                $sqlQuery2->execute(["nomAdd" => $nom, "prenomAdd" => $prenom, "sexeAdd" => $sexe, "date_naissanceAdd" => $date_naissance]);
                $id_personne = $sqlQuery2->fetch()[0];//c'est un array, je cherche donc là la plemière valeur retourné
            
            if (!$id_personne){
                $sqlQuery = $pdo->prepare("
                INSERT INTO personne (nom, prenom, sexe, date_naissance)
                VALUES (:nomAdd, :prenomAdd, :sexeAdd, :date_naissanceAdd)");
                $sqlQuery->execute(["nomAdd" => $nom, "prenomAdd" => $prenom, "sexeAdd" => $sexe, "date_naissanceAdd" => $date_naissance]);
                $id_personne = $pdo->lastInsertId();//récupère l'id_personne du dernier insert
            }
            
            
            $sqlQuery3 = $pdo->prepare("
                SELECT acteur.id_acteur
                FROM acteur
                INNER JOIN personne ON acteur.id_personne = personne.id_personne
                WHERE acteur.id_personne = :id_personneAdd");
                $sqlQuery3->execute(["id_personneAdd" => $id_personne]);
                $id_acteur = $sqlQuery3->fetch();

            if (!$id_acteur){
                $sqlQuery4 = $pdo->prepare("
                INSERT INTO acteur (id_personne)
                VALUES (:id_personneAdd)");
                $sqlQuery4->execute(["id_personneAdd" => $id_personne]);
            }
            else{
                $erreur = "cet acteur existe déjà";
                $_SESSION['messages'] = $erreur;
            }
            
        }
        header("Location: index.php?action=listActeurs");
    }

    public Function listRealisateurs(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT id_realisateur, prenom, nom
            FROM personne
            INNER JOIN realisateur ON personne.id_personne = realisateur.id_personne
            ORDER BY nom
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
        SELECT id_film, titre, annee_sortie
        FROM Realisateur
        INNER JOIN film ON film.id_realisateur = realisateur.id_realisateur
        WHERE realisateur.id_realisateur = :id
        ORDER BY annee_sortie
        ");
        $requeteFilmographie->execute( ["id" => $id]);

        require "view/detailRealisateur.php";

    }

    public Function listGenres(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT id_genre, libelle
            FROM genre
            ORDER BY libelle
        ");

        require "view/listGenres.php";
    }

    public function addGenre() {
        
        $libelle = filter_input(INPUT_POST, "libelle", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        if($libelle){
            $pdo = Connect::seConnecter();  
            $sqlQuery2 = $pdo->prepare("
                    SELECT libelle
                    FROM genre
                    WHERE libelle = :libelle");
                    $sqlQuery2->execute(["libelle" => $libelle]);
                    $id_genre = $sqlQuery2->fetchAll();
            
                if (!$id_genre){
                    $sqlQuery = $pdo->prepare("
                    INSERT INTO genre (libelle)
                    VALUES (:libelleAdd)");
                    $sqlQuery->execute(["libelleAdd" => $libelle]);
                }
                else{
                    $erreur = "ce genre existe déjà";
                    $_SESSION['messages'] = $erreur;
                }
                header("Location: index.php?action=listGenres");
        }
        
    }

}
              
   

