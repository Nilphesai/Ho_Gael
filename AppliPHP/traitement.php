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


    // var_dump($id);die;

    if(isset($_GET['action'])){
        switch($_GET['action']){
            case "add":
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
                $image = htmlspecialchars($file);
                $name = htmlspecialchars(filter_input(INPUT_POST, "name"));
                $timePrep = filter_input(INPUT_POST, "timePrep", FILTER_VALIDATE_INT);
                $instruct = htmlspecialchars(filter_input(INPUT_POST, "instruct"));
                $typePlat = htmlspecialchars(filter_input(INPUT_POST, "typePlat"));
                $nameIngredient = htmlspecialchars(filter_input(INPUT_POST, "nameIngredient"));
                $unity = htmlspecialchars(filter_input(INPUT_POST, "unity"));
                $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $quantity = filter_input(INPUT_POST, "quantity", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                if($name && $timePrep && $instruct && $typePlat && $nameIngrediant && $unity && $price && $quantity){//tant que ce n'est pas négatif ou null
                    $sqlQuery = "INSERT INTO recipe (recipe_name,preparation_time,instructions,id_category)
                    VALUE ('".$name."',".$timePrep.",'".$instruct."',".$typePlat.");";
                    $recettesStatement = $mysqlClient->prepare($sqlQuery);
                    $recettesStatement->execute();
                    
                    $sqlQuery2 = "INSERT INTO ingredient (ingredient_name, unity, price)
                    VALUE ('".$nameIngredient."',".$unity.",".$price.");";
                    $ingredientsStatement = $mysqlClient->prepart($sqlQuery2);
                    $ingredientsStatement->execute();

                    

                    $ajout = $name." ajouter avec succes !";
                    $_SESSION['messages'] = $ajout;
                }



                else{
                    $erreur = "valeur d'entrée incorrecte, veuillé réessayer";
                    $_SESSION['messages'] = $erreur;
                }
                header("Location:index.php");
                break;


        }
    }