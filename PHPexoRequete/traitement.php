<?php

session_start();

if(isset($_GET["action"])){
    switch($_GET["action"]){
        case "register":

            if($_POST["submit"]){
                $pdo = new PDO("mysql:host=localhost;dbname=forum;charset=utf8", "root", "");

                $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
                if($pseudo && $email && $pass1 && $pass2){
                    $requete = $pdo->prepare("SELECT * FROM user WHERE email = :email");
                    $requete->execute([":email" => $email]);
                    $user = $requete->fetch();
                    if($user){
                        header("Location: register.php");exit;
                    }
                    else {
                        if($pass1 == $pass2 && strlen($pass1) >= 5){
                            $insertUser = $pdo->prepare("INSERT INTO user (pseudo, email, password) VALUES (:pseudo, :email, :password)");
                            $insertUser->execute([
                                "pseudo"=>$pseudo,
                                "email"=>$email,
                                "password"=>password_hash($pass1, PASSWORD_DEFAULT)
                            ]);
                            header("Location: login.php");exit;

                        } else{

                        }
                    }
                } else{

                }

            }
            header("Location : register.php"); exit;
        
        break;

        case "login":

            if($_POST["submit"]){
                $pdo = new PDO("mysql:host=localhost;dbname=forum;charset=utf8", "root", "");

                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if($email && $password){
                    $requete = $pdo->prepare("SELECT * FROM user WHERE email = :email");
                    $requete->execute([":email" => $email]);
                    $user = $requete->fetch();
                    if($user){
                        $hash = $user["password"];
                        if(password_verify($password, $hash)){
                            $_SESSION["user"]=$user;
                            header("Location: home.php");
                        } else {
                            header("Location: login.php");
                        }
                    } else {
                        header("Location: login.php");
                    }
                }
            }

            header("Location: login.php");exit;
        break;

        case "profil":
            header("Location: profil.php"); exit;

        case "logout":
            unset($_SESSION["user"]);
            header("Location: home.php");exit;
        break;
    }

}