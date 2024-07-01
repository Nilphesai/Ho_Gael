<?php ob_start(); ?>

<p class="ok-label uk-label-marging">Il y a <?= $requete->rowCount() ?> films</p>

<table class="uk-table uk-table-striped">
    <thread>
        <tr>
            <th>TITRE</th>
            <th>ANNEE SORTIE</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $film) { ?>
                <tr>
                    <td><a href='index.php?action=detailFilm&id=<?=$film["id_film"] ?>' ><?= $film["titre"] ?></td>
                    <td><?= $film["annee_sortie"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>
<h1>Ajouter un Film</h1>
    <form id="formPrincipal" action="index.php?action=addFilm" method="post">
        <p>
            <label>
                Titre :
                <input type="text" name="titre">
            </label>
        </p>
        <p>
            <label>
                durée (en min) :
                <input type="number" name="date_naissance">
            </label>
        </p>
        <p>
            <label>
                Synopsis :
                <input type="text" name="synopsis">
            </label>
        </p>
        <p>
            <label>
                note :
                <input type="number" name="note">
            </label>
        </p>
        <p>
            <label>
                date de sortie (seul l'année sera prise en compte) :
                <input type="date" name="date_sortie">
            </label>
        </p>
        <p>
        <label for="realisateur-select">Réalisateur :</label>

        <select name="listRealisateur" id="realisateur-select">
        <option value="">--Please choose an option--</option>
        <?php
            foreach($requeteRealisateur->fetchAll() as $realisateur) { ?>
                    <option value=<?=$realisateur["id_realisateur"] ?>><?=$realisateur["nom"]?> <?=$realisateur["prenom"]?> </option>      
        <?php } ?>
            </select>
        </p>
        <label for="file" id="namefile">affiche :</label>
        <input type="file" name="file">

        <p>
            <input type="submit" name="submit" value="Ajouter le film">
        </p>
    </form>
<?php

$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "view/template.php";