<?php ob_start(); ?>

<p class="ok-label uk-label-marging">detail Realisateur</p>

<table class="uk-table uk-table-striped">
    <thread>
        <?php
        $Realisateur = $requeteRealisateur->fetch();
        echo $Realisateur["nom"]." ";
        echo $Realisateur["prenom"]."</br>";
        echo $Realisateur["sexe"]."</br>";
        echo "née le ".$Realisateur["dateNaissance"]."</br>";
        
       ?>
        <tr>
            <th>Film</th>
            <th>Année de sortie</th>
        </tr>
    </thead>
    <tbody>
        <?php
            
            $Filmographies = $requeteFilmographie->fetchAll();
            foreach($Filmographies as $film) { ?>
                <tr>
                    <td><a href='index.php?action=detailFilm&id=<?=$film["id_film"] ?>' ><?= $film[1] ?></td>
                    <td><?= $film[2] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<?php

$titre = "détail Réalisateur";
$titre_secondaire = "détail Réalisateur";
$contenu = ob_get_clean();
require "view/template.php";