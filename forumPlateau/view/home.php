<div class="jumbotron">
<h1 class="display-3">BIENVENUE SUR LE FORUM</h1>

<p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ut nemo quia voluptas numquam, itaque ipsa soluta ratione eum temporibus aliquid, facere rerum in laborum debitis labore aliquam ullam cumque.</p>

<p>
    <?php
if(isset($_SESSION["user"])){ ?>
    <hr class="my-4">
    <p class="lead"> Bienvenue <?=$_SESSION["user"]?></p>
<?php } else{ ?>
    <a class="btn btn-primary btn-lg" role="button" href="index.php?ctrl=security&action=login"> Se connecté</a>
    <span>&nbsp;-&nbsp;</span>
    <a class="btn btn-primary btn-lg" role="button" href="index.php?ctrl=security&action=register"> S'inscrire</a>
    <?php } 
    ?>
    
</p>
</div>