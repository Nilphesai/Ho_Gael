<?php
    $user = $result["data"]['user']; 
?>

<h1>Mon profil</h1>
    <?php
    //var_dump($user);die;
    if(isset($_SESSION["user"])){
        var_dump($user);
    }
        
    ?>

    <p>Pseudo : <?=$user->getNickName()?></p>
    <p>Email : <?=$user->getEmail()?></p>
    <p>date d'inscription : <?=$user->getSignDate()?></p>