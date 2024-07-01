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
<h1>Ajouter un acteur</h1>
    <form id="formPrincipal" action="index.php?action=addActeur" method="post">
        <p>
            <label>
                Nom :
                <input type="text" name="nom">
            </label>
        </p>
        <p>
            <label>
                Prénom :
                <input type="text" name="prenom">
            </label>
        </p>

        <p>
            <label>
                sexe :</br>
                <input type="radio" name="sexe" id="Homme" value="Homme">
                <label for="typePlat">Homme</label></br>
                <input type="radio" name="sexe" id="Femme" value="Femme">
                <label for="typePlat">Femme</label></br>
            </label>
        </p> 
        <p>
            <label>
                date de naissance :
                <input type="date" name="date_naissance">
            </label>
        </p>
        <p>
            <input type="submit" name="submit" value="Ajouter acteur">
        </p>
    </form>
    
<?php 
    if(isset($_SESSION['messages'])){
        echo $_SESSION["messages"];
        } 



$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$contenu = ob_get_clean();
require "view/template.php";