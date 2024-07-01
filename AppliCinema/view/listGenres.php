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

<?php

$titre = "Liste des genres";
$titre_secondaire = "Liste des genres";
$contenu = ob_get_clean();
require "view/template.php";