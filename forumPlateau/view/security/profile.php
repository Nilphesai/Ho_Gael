<?php
    $user = $result["data"]['user']; 
?>
<div class="jumbotron">
<h1 class="display-3">Mon profil</h1>
    <div>
    <p class="lead">Pseudo : <?=$user->getNickName()?></p>
    <p class="lead">Email : <?=$user->getEmail()?></p>
    <p class="lead">date d'inscription : <?=$user->getSignDate()?></p>
    </div>
</div>