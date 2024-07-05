<?php
    $user = $result["data"]['user']; 
?>

<h1>Mon profil</h1>

    <p>Pseudo : <?=$user->getNickName()?></p>
    <p>Email : <?=$user->getEmail()?></p>
    <p>date d'inscription : <?=$user->getSignDate()?></p>