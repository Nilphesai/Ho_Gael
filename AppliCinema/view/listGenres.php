<?php ob_start(); ?>

<p class="ok-label uk-label-marging">Il y a <?= $requete->rowCount() ?> Genres</p>

<table class="uk-table uk-table-striped">
    <thread>
        <tr>
            <th>Libelle</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $genre) { ?>
                <tr>
                    <td><a href='index.php?action=listFilmParGenre&id=<?=$genre["id_genre"] ?>' > <?=$genre["libelle"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<h1>Ajouter un genre</h1>
    <form id="formPrincipal" action="index.php?action=addGenre" method="post" enctype="multipart/form-data">
        <p>
            <label>
                Nom du genre :
                <input type="text" name="libelle">
            </label>
        </p>
        <p>
            <input type="submit" name="submit" value="Ajouter ce genre">
        </p>
    </form>
    <?php 
    if(isset($_SESSION['messages'])){
        echo $_SESSION["messages"];
        } ?>
<?php
$titre = "Liste des genres";
$titre_secondaire = "Liste des genres";
$contenu = ob_get_clean();
require "view/template.php";