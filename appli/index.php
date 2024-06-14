<?php
    session_start();
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
    </header>

    <h1>Ajouter un produit</h1>
    <form action="traitement.php?action=add" method="post">
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
        <p>
            <input type="submit" name="submit" value="Ajouter le produit">
        </p>
    </form>
    <form action="index.php" method="POST" enctype="multipart/form-data">
        <label for="file">Fichier</label>
        <input type="file" name="file">
        <button type="submit">Enregistrer</button>
    </form>

    <?php 
    $tmpName = $_FILES['file']['tmp_name'];
    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
    var_dump($_POST);
    var_dump($_FILES);
    move_uploaded_file($tmpName, './upload/'.$name);
    echo $_SESSION["messages"]; ?>
</body>
</html>