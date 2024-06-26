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

    if(isset($_GET['action'])){
        switch($_GET['action']){
            case "add":
                $nombreChamps = count($_POST);
                echo "Nombre de champs envoyés : " . $nombreChamps;
                if(isset($_FILES['file'])){
                    $tmpName = $_FILES['file']['tmp_name'];
                    $name = $_FILES['file']['name'];
                    $size = $_FILES['file']['size'];
                    $error = $_FILES['file']['error'];
            
                    $tabExtension = explode('.', $name);
                    $extension = strtolower(end($tabExtension));
                    $extensions = ['jpg', 'png', 'jpeg', 'gif'];
                    $maxSize = '4000000';
                    if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){
                        $uniqueName = uniqid('', true);
                        $file = $uniqueName.'.'.$extension;
                        move_uploaded_file($tmpName, './upload/'.$file);
                        $_SESSION['file'] = $file;
                    }
                    else{
                        echo "Une erreur est survenue";
                    } 
                }
                $dividende = count($_POST) - 9;
                $diviseur = 4;
                $nombreFormulaire = intdiv($dividende,$diviseur);
                                
                $image = htmlspecialchars($file);
                $name = htmlspecialchars(filter_input(INPUT_POST, "name"));
                $timePrep = filter_input(INPUT_POST, "timePrep", FILTER_VALIDATE_INT);
                $instruct = htmlspecialchars(filter_input(INPUT_POST, "instruct"));
                $typePlat = filter_input(INPUT_POST, "typePlat", FILTER_VALIDATE_INT);
                for ($i=0;$i <= $nombreFormulaire;$i++){
                    
                    $nameIngredient = htmlspecialchars(filter_input(INPUT_POST, "nameIngredient".$i));
                    $unity = htmlspecialchars(filter_input(INPUT_POST, "unity".$i));
                    $price = filter_input(INPUT_POST, "price".$i, FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $quantity = filter_input(INPUT_POST, "quantity".$i, FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    if($name && $timePrep && $instruct && $typePlat && $nameIngredient && $unity && $price && $quantity && $image){//tant que ce n'est pas négatif ou null
                        $sqlQuery3 = "SELECT id_ingredient
                        FROM ingredient
                        WHERE ingredient_name = '".$nameIngredient."';";
                        echo $sqlQuery3;
                        $id_ingredientsStatement = $mysqlClient->prepare($sqlQuery3);
                        $id_ingredientsStatement->execute();
                        $id_ingredients = $id_ingredientsStatement->fetchAll();

                        $sqlQuery4 = "SELECT id_recipe
                        FROM recipe
                        WHERE recipe_name = '".$name."';";
                        $id_recettesStatement = $mysqlClient->prepare($sqlQuery4);
                        $id_recettesStatement->execute();
                        $id_recettes = $id_recettesStatement->fetchAll();
                        if (!$id_recettes){
                        
                            $sqlQuery = "INSERT INTO recipe (recipe_name,preparation_time,instructions,id_category,image)
                            VALUE ('".$name."',".$timePrep.",'".$instruct."',".$typePlat.",'".$image."');";
                            $recettesStatement = $mysqlClient->prepare($sqlQuery);
                            $recettesStatement->execute();

                            $sqlQuery4 = "SELECT id_recipe
                            FROM recipe
                            WHERE recipe_name = '".$name."';";
                            $id_recettesStatement = $mysqlClient->prepare($sqlQuery4);
                            $id_recettesStatement->execute();
                            $id_recettes = $id_recettesStatement->fetchAll();
                            
                            $ajout .= $name." crée !</br>";
                        }
                    
                        if (!$id_ingredients){
                            $sqlQuery2 = "INSERT INTO ingredient (ingredient_name, unity, price)
                            VALUE ('".$nameIngredient."','".$unity."',".$price.");";
                            $ingredientsStatement = $mysqlClient->prepare($sqlQuery2);
                            $ingredientsStatement->execute();

                            $sqlQuery3 = "SELECT id_ingredient
                            FROM ingredient
                            WHERE ingredient_name = '".$nameIngredient."';";
                            echo $sqlQuery3;
                            $id_ingredientsStatement = $mysqlClient->prepare($sqlQuery3);
                            $id_ingredientsStatement->execute();
                            $id_ingredients = $id_ingredientsStatement->fetchAll();
                            
                            $ajout .= $nameIngredient." crée !</br>";
                        }

                        $sqlQuery5 = "INSERT INTO recipe_ingredients (quantity, id_ingredient, id_recipe)
                        VALUE (".$quantity.",".$id_ingredients[0][0].",".$id_recettes[0][0].");";
                        echo $sqlQuery5;
                        $id_recettesStatement = $mysqlClient->prepare($sqlQuery5);
                        $id_recettesStatement->execute();

                        $ajout .= $nameIngredient." ajouté avec succes !</br>";
                        $_SESSION['messages'] = $ajout;
                    }

                    else{
                        $erreur = "valeur d'entrée incorrecte, veuillé réessayer";
                        $_SESSION['messages'] = $erreur;
                    }
                    
                }
                header("Location:index.php");
                break;

            case "plus_ingredient":
                $nameIngredient = htmlspecialchars(filter_input(INPUT_POST, "nameIngredient"));
                $unity = htmlspecialchars(filter_input(INPUT_POST, "unity"));
                $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $quantity = filter_input(INPUT_POST, "quantity", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                if($nameIngredient && $unity && $price && $quantity){//tant que ce n'est pas négatif ou null
                    $sqlQuery3 = "SELECT id_ingredient
                    FROM ingredient
                    WHERE ingredient_name = '".$nameIngredient."';";
                    $id_ingredientsStatement = $mysqlClient->prepare($sqlQuery3);
                    $id_ingredientsStatement->execute();
                    $id_ingredients = $id_ingredientsStatement->fetchAll();
                    if(!$id_ingredients){
                        $sqlQuery2 = "INSERT INTO ingredient (ingredient_name, unity, price)
                        VALUE ('".$nameIngredient."','".$unity."',".$price.");";
                        $ingredientsStatement = $mysqlClient->prepare($sqlQuery2);
                        $ingredientsStatement->execute();

                        $sqlQuery3 = "SELECT id_ingredient
                        FROM ingredient
                        WHERE ingredient_name = '".$nameIngredient."';";
                        $id_ingredientsStatement = $mysqlClient->prepare($sqlQuery3);
                        $id_ingredientsStatement->execute();
                        $id_ingredients = $id_ingredientsStatement->fetchAll();
                    }
                    $sqlQuery4 = "SELECT id_recipe
                    FROM recipe
                    WHERE recipe_name = '".$_GET['ing']."';";
                    $id_recettesStatement = $mysqlClient->prepare($sqlQuery4);
                    $id_recettesStatement->execute();
                    $id_recettes = $id_recettesStatement->fetchAll();

                    $sqlQuery5 = "INSERT INTO recipe_ingredients (quantity, id_ingredient, id_recipe)
                    VALUE (".$quantity.",".$id_ingredients[0][0].",".$id_recettes[0][0].");";
                    $id_recettesStatement = $mysqlClient->prepare($sqlQuery5);
                    $id_recettesStatement->execute();
                    
                    $ajout = $nameIngredient." ajouter avec succes !";
                    $_SESSION['messages'] = $ajout;
                    header("Location:detail.php?action=detail&id=".$id_recettes[0][0]);
                    break;
                }
                else{
                    $erreur = "valeur d'entrée incorrecte, veuillé réessayer";
                    $_SESSION['messages'] = $erreur;
                    header("Location:detail.php?action=detail&id=NULL");
                    break;
                }
        }
    }