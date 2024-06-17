<?php
    session_start();


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
                $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
                if($name && $price && $qtt){//tant que ce n'est pas négatif ou null
                    $product =[
                        "image" => $image,
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
                unlink("./upload/".$_SESSION['products'][$_GET["id"]]['image']);
                unset($_SESSION['products'][$_GET["id"]]);
                header("Location:recap.php");
                break;
            case "clear":
                if(isset($_SESSION['products'])){
                    $tousImages = glob("./upload/*");
                    foreach($tousImages as $uneImage){
                        unlink($uneImage);
                    }
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
                    unlink("./upload/".$_SESSION['products'][$_GET["id"]]['image']);
                    unset($_SESSION['products'][$_GET["id"]]);
                }
                header("Location:recap.php");
                break;


        }
    }