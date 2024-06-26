<?php ob_start(); ?>

<p class="ok-label uk-label-marging">Il y a <?= $requete->rowCount() ?> réalisateurs</p>

<table class="uk-table uk-table-striped">
    <thread>
        <tr>
            <th>Prenom</th>
            <th>Nom</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $personne) { ?>
                <tr>
                    <td><a href='index.php?action=detailRealisateur&id=<?=$personne["id_realisateur"] ?>' ><?= $personne["prenom"] ?></td>
                    <td><a href='index.php?action=detailRealisateur&id=<?=$personne["id_realisateur"] ?>' ><?= $personne["nom"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<?php

$titre = "Liste des réalisateurs";
$titre_secondaire = "Liste des réalisateurs";
$contenu = ob_get_clean();
require "view/template.php";