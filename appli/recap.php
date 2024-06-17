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
        <meta charset = "UTF_8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <title>Récapitulatif des produits</title>
    </head>
<body>
    <header>
        <a href="http://localhost/Ho_Gael/appli/index.php">acceuil</a>
        <a href="http://localhost/Ho_Gael/appli/recap.php">Vos commandes <?php echo $compteur ?></a>
    </header>
    <?php
        
        if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
            echo "<P>Aucun produit en session...</>";
        }
        else{
            echo "<table class='table'>",
                    "<Thead>",
                        "<tr>",
                            "<th>#</th>",
                            "<th>image</th>",
                            "<th>Nom</th>",
                            "<th>Prix</th>",
                            "<th>Quantité</th>",
                            "<th>Total</th>",
                            "<th></th>",
                        "</tr>",
                    "</tread>",
                    "<tbody>";
            $totalGeneral = 0;
            foreach($_SESSION['products'] as $index => $product){
                
                echo "<tr>",
                    "<td>".$index."</td>",
                    "<td><img src=./upload/".$product['image']." width=10% height=10%></td>",
                    "<td>".$product['name']."</td>",
                    "<td>".number_format($product['price'],2,",","&nbsp;")."&nbsp;€</td>",
                    "<td><a href='traitement.php?action=up-qtt&id=$index'>+</a>".$product['qtt']."<a href='traitement.php?action=down-qtt&id=$index'>-</a></td>",
                    "<td>".number_format($product['total'],2,",","&nbsp;")."&nbsp;€</td>",
                    "<td><a href='traitement.php?action=delete&id=$index'>Supprimer</a></td>",
                    "</tr>";
                $totalGeneral+= $product['total'];
            }
            
            echo "<tr>",
                    "<td coldpan=4>Total général : </td>",
                    "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                 "</tr>",
                "</tbody>",
            "</table>";
        }

        
    ?>
    
    <form action="traitement.php?action=clear" method="post">
    <p>
    <input type="submit" name="clear" value="Enlever tout les produits">
    </p>
    </form>
    <?php echo $_SESSION["messages"]; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>