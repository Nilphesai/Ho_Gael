<?php
    session_start();
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
        <a href="http://localhost/Ho_Gael/appli/recap.php">Vos commandes <?php echo "(".count($_SESSION['products']).")";?></a>
    </header>
    <?php
        $list_delete = "<select>";
        if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
            echo "<P>Aucun produit en session...</>";
        }
        else{
            echo "<table class='table'>",
                    "<Thead>",
                        "<tr>",
                            "<th>#</th>",
                            "<th>Nom</th>",
                            "<th>Prix</th>",
                            "<th>Quantité</th>",
                            "<th>Total</th>",
                        "</tr>",
                    "</tread>",
                    "<tbody>";
            $totalGeneral = 0;
            foreach($_SESSION['products'] as $index => $product){
                $list_delete .="<option value='$index name='$product[name]'>$product[name]</option>";
                echo "<tr>",
                    "<td>".$index."</td>",
                    "<td>".$product['name']."</td>",
                    "<td>".number_format($product['price'],2,",","&nbsp;")."&nbsp;€</td>",
                    "<td><form action='traitement.php?action=up-qtt' method='post'><input type='button' name='plus".$index."' value='-'></form>".$product['qtt']."<form action='traitement.php?action=down-qtt' method='post'><input type='button' name='moins".$index."' value='+'></form></td>",
                    "<td>".number_format($product['total'],2,",","&nbsp;")."&nbsp;€</td>",
                    "</tr>";
                $totalGeneral+= $product['total'];
            }
            $list_delete .="</select>";
            echo "<tr>",
                    "<td coldpan=4>Total général : </td>",
                    "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                 "</tr>",
                "</tbody>",
            "</table>";
        }

        
    ?>
    
    <form action="traitement.php?action=delete" method="post">
    <p>
    <?php echo $list_delete ?>
    <input type="submit" name="delete" value="Enlever le produit">
    </p>
    </form>
    <form action="traitement.php?action=clear" method="post">
    <p>
    <input type="submit" name="clear" value="Enlever tout les produits">
    </p>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>