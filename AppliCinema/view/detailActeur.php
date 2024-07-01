<?php ob_start(); ?>

<p class="ok-label uk-label-marging">detail Acteur</p>

<table class="uk-table uk-table-striped">
    <thread>
        <?php
        $acteur = $requeteActeur->fetch();

        echo $acteur["nom"]." ";
        echo $acteur["prenom"]."</br>";
        echo $acteur["sexe"]."</br>";
        echo "né le ".$acteur["dateNaissance"]."</br>";
        
       ?>
        <tr>
            <th>Film</th>
            <th>année sortie</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        <?php
            
            $casting = $requeteCasting->fetchAll();
            foreach($casting as $cast) { ?>
                <tr>
                    <td><a href='index.php?action=detailFilm&id=<?=$cast[3] ?>' ><?= $cast[0] ?></td>
                    <td><?= $cast[1] ?></td>
                    <td><?= $cast[2] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<?php

$titre = "détail Acteur";
$titre_secondaire = "détail Acteur";
$contenu = ob_get_clean();
require "view/template.php";