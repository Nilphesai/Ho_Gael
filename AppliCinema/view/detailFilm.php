<?php ob_start(); ?>

<p class="ok-label uk-label-marging">detail film</p>

<table class="uk-table uk-table-striped">
    <thread>
        <?php
        $film = $requeteFilm->fetch();
        echo "<img src=./public/img/".$film["affiche"]." width=30% height=30%></br>";
        echo $film["titre"]."</br>";
        echo $film["duree"]." min</br>";
        echo $film["synopsis"]."</br>";
        echo $film["note"]."</br>";
        echo $film["annee_sortie"]."</br>";
        
        $realisateur = $requeteRealisateur->fetch();
        echo $realisateur[0]." ";
        echo $realisateur[1];?>
        <tr>
            <th>genre</th>
        </tr>
        <?php
            
            $genres = $requeteGenre->fetchAll();
            foreach($genres as $genre) { ?>
                <tr>
                    <td><?= $genre[0] ?></td>
                </tr>
        <?php } ?>
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