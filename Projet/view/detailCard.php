<?php ob_start(); ?>

<p class="ok-label uk-label-marging">detail Carte</p>

<table class="uk-table uk-table-striped">
    <thread>
        <?php
        $card = $requeteCard->fetch();
        echo "<img src=./public/img/".$card["image"]." width=50% height=50%></br>";
        echo $card["name"]."</br>";
        echo $card["typeCard"]." min</br>";
        echo $card["effect"]."</br>";
        echo $card["level"]."</br>";
        echo $card["attack"]."</br>";
        echo $card["defense"]."</br>";
        
        ?>
    </thead>
    
</table>

<?php

$titre = "détail de la carte";
$titre_secondaire = "détail de la carte";
$contenu = ob_get_clean();
require "view/template.php";