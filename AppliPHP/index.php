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
$sqlQuery = 'SELECT id_recipe, recipe_name, preparation_time, category_name, image
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
     echo "<tr>",
        "<td><img src=./upload/".$recipe['image']." width=10% height=10%></td>",
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
    <form id="formPrincipal" action="traitement.php?action=add" method="post" enctype="multipart/form-data">
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
                <input type="textarea" name="instruct">
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
   <fieldset id="formIngredients">
   <legend>ingrédient liée au plat</legend>
        <div id="originalForm0">
        
        <p>
            <label>
                Nom de l'ingredient :
                <input type="text" name="nameIngredient0">
            </label>
            </p>
            <p>
            <label>
                unité de mesure:
                <input type="text" name="unity0">
            </label>
            </p>

            <p>
            <label>
                prix :
                <input type="number" name="price0">
            </label>
            </p>

            <p>
            <label>
                quantité :
                <input type="number" name="quantity0">
            </label>
            </p>
</fieldset>
        </div>
    
<label for="file" id="namefile">Fichier</label>
        <input type="file" name="file">
        <p>
            <input type="submit" name="submit" value="Ajouter la recette">
        </p>
    </form>
    <button onclick="duplicateForm()">ajouter un ingrédient supplémentaire</button>
    
        
        
    

    
    <script>
        var i=1;
        function duplicateForm() {
            
            const originalForm = document.getElementById("originalForm0");
            const clonedForm = originalForm.cloneNode(true);
            // Modifiez les attributs "name" des champs clonés si nécessaire
            // Parcourez tous les champs de saisie clonés
            clonedForm.id = "originalForm"+i;
            clonedForm.getElementsByTagName("input")[0].name = "nameIngredient"+i;
            clonedForm.getElementsByTagName("input")[1].name = "unity"+i;
            clonedForm.getElementsByTagName("input")[2].name = "price"+i;
            clonedForm.getElementsByTagName("input")[3].name = "quantity"+i;
            /*clonedForm.querySelectorAll("input").forEach((input, index) => {
                input.name = `quantity${index + $i}`;
                $i++
            });*/
            i=i+1;
            const principalForm = document.getElementById("formIngredients")
            principalForm.appendChild(clonedForm);
            
        }
    </script>


    

    <?php 
    if(isset($_SESSION['messages'])){
        echo $_SESSION["messages"];
        } ?>
</body>
</html>