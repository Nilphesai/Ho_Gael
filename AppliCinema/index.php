<?php

use controller\CinemaController;

spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();

$id = (isset($_GET["id"])) ? $_GET["id"] : null;
//$type = (isset($_GET["type"])) ? $_GET["type"] : null;

if(isset($_GET["action"])){
    switch ($_GET["action"]){

        case "listFilms" : $ctrlCinema->listFilms(); break;
        case "detailFilm": $ctrlCinema->detailFilm($id); break;

        case "listActeurs" : $ctrlCinema->listActeurs(); break;
        case "detailActeur": $ctrlCinema->detailActeur($id); break;

        case "listRealisateurs" : $ctrlCinema->listRealisateurs(); break;
        case "detailRealisateur" : $ctrlCinema->detailRealisateur($id); break;
    
        case "listGenres" : $ctrlCinema->listGenres(); break;
        case "listFilmParGenre" : $ctrlCinema->listFilmParGenre($id); break;

        case "addGenre": $ctrlCinema->addGenre();
    }
}