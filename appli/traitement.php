<?php
    session_start();


    // var_dump($id);die;

    if(isset($_GET['action'])){
        switch($_GET['action']){
            case "add":
                $name = htmlspecialchars(filter_input(INPUT_POST, "name"));
                $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
                if($name && $price && $qtt){//tant que ce n'est pas négatif ou null
                    $product =[
                        "name" => $name,
                        "price" => $price,
                        "qtt" => $qtt,
                        "total" => $price*$qtt
                        ];
                    $_SESSION['products'][] = $product;
                    $ajout = $name." ajouter avec succes !";
                    $_SESSION['messages'] = $ajout;
                }
                else{
                    $erreur = "valeur d'entrée incorrecte, veuillé réessayer";
                    $_SESSION['messages'] = $erreur;
                }
                header("Location:index.php");
                break;
            case "delete":
                $suppression = $_SESSION['products'][$_GET["id"]]['name']." supprimé";
                $_SESSION['messages'] = $suppression;
                unset($_SESSION['products'][$_GET["id"]]);
                header("Location:recap.php");
                break;
            case "clear":
                if(isset($_SESSION['products'])){
                    unset($_SESSION['products']);
                }
                $suppression ="tableau vidé";
                $_SESSION['messages'] = $suppression;
                header("Location:recap.php");
                break;
            case "up-qtt":
                $_SESSION["products"][$_GET["id"]]["qtt"]++;
                header("Location:recap.php");
                break;
            case "down-qtt":
                $_SESSION["products"][$_GET["id"]]["qtt"]--;
                if ($_SESSION["products"][$_GET["id"]]["qtt"] == 0){
                    $suppression = $_SESSION['products'][$_GET["id"]]['name']." supprimé";
                    $_SESSION['messages'] = $suppression;
                    unset($_SESSION['products'][$_GET["id"]]);
                }
                header("Location:recap.php");
                break;


        }
    }