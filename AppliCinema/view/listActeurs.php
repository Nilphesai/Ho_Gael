<?php ob_start(); ?>

<p class="ok-label uk-label-marging">Il y a <?= $requete->rowCount() ?> acteurs</p>

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
                    <td><a href='index.php?action=detailActeur&id=<?=$personne["id_acteur"] ?>' > <?=$personne["prenom"] ?></td>
                    <td><a href='index.php?action=detailActeur&id=<?=$personne["id_acteur"] ?>' > <?= $personne["nom"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<?php

$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$contenu = ob_get_clean();
require "view/template.php";