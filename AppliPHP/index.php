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
                            "<th>plat</th>",
                            "<th>temps de préparation</th>",
                            "<th>type de plat</th>",
                        "</tr>",
                    "</tread>",
                    "<tbody>";
foreach ($recipes as $recipe) {            
     echo "<tr>",
        "<td><a href='detail.php?action=detail&id=$recipe[id_recipe]'>".$recipe['recipe_name']."</a></td>",
        "<td><a href='detail.php?action=detail&id=$recipe[id_recipe]'>".$recipe['preparation_time']."</a></td>",
        "<td><a href='detail.php?action=detail&id=$recipe[id_recipe]'>".$recipe['category_name']."</td></a>",
        "</tr>";

}
?>