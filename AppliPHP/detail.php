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

$sqlQuery = 'SELECT recipe_name, ingredient_name, preparation_time, category_name, quantity, unity, instructions, image
FROM ingredient
INNER JOIN recipe_ingredients ON ingredient.id_ingredient = recipe_ingredients.id_ingredient
JOIN recipe ON recipe_ingredients.id_recipe = recipe.id_recipe
JOIN category ON recipe.id_category = category.id_category
WHERE recipe.id_recipe ='.$_GET['id'];
$ingredientsStatement = $mysqlClient->prepare($sqlQuery);
$ingredientsStatement->execute();
$ingredients = $ingredientsStatement->fetchAll();

echo "<table class='table'>",
        "<Thead>",
            "<tr>",
               "<th>".$ingredients[0][0]."</th>",
               "<th>".$ingredients[0][3]."</th>",
               "<th> de ".$ingredients[0][2]." min de préparation</th>",
               
            "</tr>",
        "</tread>",
"<tbody>";
foreach ($ingredients as $ingredient) {    
 echo "<tr>",
    "<td>".$ingredient['ingredient_name']."</td>",
    "<td>".$ingredient['quantity']."</td>",
    "<td>".$ingredient['unity']."</td>",
    "</tr>";
}

echo 
    "</tbody>",
        "</table>",

    "<p><img src= ./upload/".$ingredient['image']." width=10% height=10%></p></br>
    <p>".$ingredient['instructions']."</p>";

?>