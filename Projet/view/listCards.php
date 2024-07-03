<?php ob_start(); ?>

<p class="ok-label uk-label-marging">Il y a <?= $requete->rowCount() ?> cartes</p>

<table class="uk-table uk-table-striped">
<thread>
        <tr>
            <th>image</th>
            <th>nom</th>
            <th>type de carte</th>
            <th>effet</th>
        </tr>
    </thead>    
    <?php
            foreach($requete->fetchAll() as $card) { ?>
                <tr>
                    <td><img src=./public/img/<?=$card["image"]?> width=100% height=100%></td>
                    <td><a href='index.php?action=detailCard&id=<?=$card["id_card"] ?>' ><?= $card["name"] ?></td>
                    <td><?= $card["typeCard"] ?></td>
                    <td><?= $card["effect"] ?></td>
                </tr>
                </tr>
        <?php } ?>
    </form>
<?php
if(isset($_SESSION['messages'])){
    echo $_SESSION["messages"];
    } 

$titre = "Liste des cartes";
$titre_secondaire = "Liste des cartes";
$contenu = ob_get_clean();
require "view/template.php";