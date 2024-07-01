<?php ob_start(); ?>

<p class="ok-label uk-label-marging">Liste de filme par genre</p>

<table class="uk-table uk-table-striped">
    <thread>
        
        
        <tr>
            <th>Films</th>
            <th>Année de sortie</th>
        </tr>
        
        <?php    
            $Films = $requeteFilms->fetchAll();
            foreach($Films as $film) { ?>
                <tr>
                    <td><a href='index.php?action=detailFilm&id=<?=$film[2] ?>' ><?= $film[0] ?></td>
                    <td><?= $film[1] ?></td>
                </tr>
        <?php } ?>
    </thead>
    
</table>

<?php

$titre = "Liste de film par genre";
$titre_secondaire = "Liste de film par genre";
$contenu = ob_get_clean();
require "view/template.php";