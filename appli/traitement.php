<?php
    session_start();

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
                break;
            case "delete":
                foreach($_SESSION['products'] as $id => $produit){
                    if ($_POST[$index] == $id){
                        unset($_SESSION['products'][$id]);
                    }
                }
                $suppression = $produit['name']." supprimé";
                $_SESSION['messages'] = $suppression;
                break;
            case "clear":
                foreach($_SESSION['products'] as $id => $produit){
                    unset($_SESSION['products'][$id]);
                }
                $suppression ="tableau vidé";
                $_SESSION['messages'] = $suppression;
                break;


        }
    }

header("Location:index.php");