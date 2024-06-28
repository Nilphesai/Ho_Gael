<?php ob_start(); ?>

<p class="ok-label uk-label-marging">detail film</p>

<table class="uk-table uk-table-striped">
    <thread>
        <?php
        $film = $requeteFilm->fetch();
        echo $film["titre"];
        echo $film["duree"];
        echo $film["synopsis"];
        echo $film["note"];
        echo $film["affiche"];
        echo $film["annee_sortie"];
        
        $realisateur = $requeteRealisateur->fetch();
        echo $realisateur[0];
        echo $realisateur[1];?>
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        <?php
            
            $casting = $requeteCasting->fetchAll();
            foreach($casting as $cast) { ?>
                <tr>
                    <td><?= $cast[0] ?></td>
                    <td><?= $cast[1] ?></td>
                    <td><?= $cast[2] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<?php

$titre = "détail du film";
$titre_secondaire = "détail du film";
$contenu = ob_get_clean();
require "view/template.php";