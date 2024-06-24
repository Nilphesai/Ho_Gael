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

$sqlQuery = 'SELECT id_recipe, ingredient_name, quantity 
FROM ingredient
INNER JOIN recipe_ingredients ON ingredient.id_ingredient = recipe_ingredients.id_ingredient
WHERE id_recipe ='.$_GET['id'];
$recipesStatement = $mysqlClient->prepare($sqlQuery);
$recipesStatement->execute();
$ingredients = $recipesStatement->fetchAll();



if(isset($_GET['action'])){
    echo "<table class='table'>",
                    "<Thead>",
                        "<tr>",
                            "<th>ingrédient</th>",
                            "<th>id_recette</th>",
                            "<th>quantité</th>",
                        "</tr>",
                    "</tread>",
                    "<tbody>";
    foreach ($ingredients as $ingredient) {       
     echo "<tr>",
        "<td>".$ingredient['ingredient_name']."</td>",
        "<td>".$ingredient['id_recipe']."</td>",
        "<td>".$ingredient['quantity']."</td>",
        "</tr>";
}
}

?>