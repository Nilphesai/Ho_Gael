<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset = "UTF_8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Récapitulatif des produits</title>
    </head>
<body>
    <?php
        if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
            echo "<P>Aucun produit en session...</>";
        }
        else{
            echo "<table>",
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
                echo "<tr>",
                    "<td>".$index."</td>",
                    "<td>".$product['name']."</td>",
                    "<td>".number_format($product['price'],2,",","&nbsp;")."&nbsp;€</td>",
                    "<td>".$product['qtt']."</td>",
                    "<td>".number_format($product['total'],2,",","&nbsp;")."&nbsp;€</td>",
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
</body>
</html>