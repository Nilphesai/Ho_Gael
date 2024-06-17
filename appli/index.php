<?php
    session_start();
    if (isset($_SESSION['products'])){
        $compteur = "(".count($_SESSION['products']).");";
    }
    else{
        $compteur = "";
    }
    if (isset($_SESSION['products'])){
        $compteur = "(".count($_SESSION['products']).");";
    }
    else{
        $compteur = "";
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-widht, initial-scale=1.0">

        <title> Ajout produit</title>
</head>
<body>
    <header>
        <a href="http://localhost/Ho_Gael/appli/index.php">acceuil</a>
        <a href="http://localhost/Ho_Gael/appli/recap.php">Vos commandes <?php echo $compteur ?></a>
        <a href="http://localhost/Ho_Gael/appli/recap.php">Vos commandes <?php echo $compteur ?></a>
    </header>

    <h1>Ajouter un produit</h1>
    <form action="traitement.php?action=add" method="post" enctype="multipart/form-data">
        <p>
            <label>
                Nom du produit :
                <input type="text" name="name">
            </label>
        </p>
        <p>
            <label>
                Prix du produit :
                <input type="number" step = "any" name="price">
            </label>
        </p> 
        <p>
            <label>
                Quantité désirée :
                <input type="number" name="qtt" value="1">
            </label>
        </p>
        <label for="file">Fichier</label>
        <input type="file" name="file">
        <p>
            <input type="submit" name="submit" value="Ajouter le produit">
        </p>
        
    </form>

    <?php 
    if(isset($_SESSION['messages'])){
        echo $_SESSION["messages"];
        } ?>
</body>
</html>