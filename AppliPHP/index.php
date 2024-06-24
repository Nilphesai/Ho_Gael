<?php
session_start();
try {
    // On se connecte à MySQL
    $mysqlClient = new PDO('mysql:host=localhost;dbname=recipe;charset=utf8', 'root', '',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}
// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table recipes
$sqlQuery = 'SELECT id_recipe, recipe_name, preparation_time, category_name 
                FROM recipe
                INNER JOIN category ON recipe.id_category = category.id_category';
$recipesStatement = $mysqlClient->prepare($sqlQuery);
$recipesStatement->execute();
$recipes = $recipesStatement->fetchAll();

// On affiche chaque recette une à une
echo "<table class='table'>",
                    "<Thead>",
                        "<tr>",
                            "<th>image</th>",
                            "<th>plat</th>",
                            "<th>temps de préparation</th>",
                            "<th>type de plat</th>",
                        "</tr>",
                    "</tread>",
                    "<tbody>";
foreach ($recipes as $recipe) {            
     echo "<tr>",//$recipe['image'] à la place de pomme.png (si la table à une colonne image)
        "<td><img src=./upload/pomme.png width=10% height=10%></td>",
        "<td><a href='detail.php?action=detail&id=$recipe[id_recipe]'>".$recipe['recipe_name']."</a></td>",
        "<td>".$recipe['preparation_time']."</td>",
        "<td>".$recipe['category_name']."</td>",
        "</tr>";
}
echo           "</tbody>",
            "</table>";
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-widht, initial-scale=1.0">

        <title> Ajout produit</title>
</head>
<body>
    <header>
    </header>

    <h1>Ajouter un plat</h1>
    <form action="traitement.php?action=add" method="post" enctype="multipart/form-data">
        <p>
            <label>
                Nom du plat :
                <input type="text" name="name">
            </label>
        </p>
        <p>
            <label>
                temps de préparation :
                <input type="number" name="timePrep">
            </label>
        </p> 
        <p>
            <label>
                instruction :
                <input type="text" name="instruct">
            </label>
        </p>
        <p>
            <label>
                type de plat :</br>
                <input type="radio" name="typePlat" id="entree" value="1">
                <label for="typePlat">Entrée</label></br>
                <input type="radio" name="typePlat" id="plat" value="2">
                <label for="typePlat">Plat</label></br>
                <input type="radio" name="typePlat" id="dessert" value="3">
                <label for="typePlat">Dessert</label>
            </label>
        </p>

   <!--     //liée avec x ingredient    -->
            <p>
            <label>
                Nom de l'ingredient :
                <input type="text" name="nameIngredient">
            </label>
            </p>
            <p>
            <label>
                unité de mesure:
                <input type="text" name="unity">
            </label>
            </p>

            <p>
            <label>
                prix :
                <input type="number" name="price">
            </label>
            </p>

            <p>
            <label>
                quantité :
                <input type="number" name="quantity">
            </label>
            </p>

        <label for="file">Fichier</label>
        <input type="file" name="file">
        <p>
            <input type="submit" name="submit" value="Ajouter le plat">
        </p>
        
    </form>
    <?php 
    if(isset($_SESSION['messages'])){
        echo $_SESSION["messages"];
        } ?>
</body>
</html>