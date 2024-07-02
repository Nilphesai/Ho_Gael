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
    <form id="formPrincipal" action="index.php?action=addFilm" method="post" enctype="multipart/form-data">
        <p>
            <label>
                Titre :
                <input type="text" name="titre">
            </label>
        </p>

        <fieldset>
  <legend>Genres:</legend>
        <?php
            foreach($requeteGenres->fetchAll() as $genre) { ?>                     
    <input type="checkbox" value=<?=$genre["id_genre"]?> name=genres[]>
    <label for=<?=$genre["libelle"]?>><?=$genre["libelle"]?></label>
  <?php } ?>
</fieldset>

        <p>
            <label>
                durée (en min) :
                <input type="number" name="duree">
            </label>
        </p>
        <p>
            <label>
                Synopsis :
                <textarea name="synopsis">Synopsis du film
                </textarea>
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
                année de sortie :
                <input type="number" name="date_sortie">
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
if(isset($_SESSION['messages'])){
    echo $_SESSION["messages"];
    } 

$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "view/template.php";