<?php
    $users = $result["data"]['users']; 
?>
<div class="jumbotron">
<h1 class="display-3">Liste des utilisateurs</h1>

<?php
foreach($users as $user ){ ?>
    <p class="lead"><a href="index.php?ctrl=security&action=profile&id=<?= $user->getId() ?>"><?= $user->getNickName() ?></a></p>
<?php }?>
</div>