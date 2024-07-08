<?php
    $topic = $result["data"]['topic']; 
    $posts = $result["data"]['posts']; 
?>

<h1>Liste des posts</h1>

    <tbody>
    <?php 
    if((App\Session::getUser() == $topic->getUser() || App\Session::isAdmin()) && $topic->getClosed()==0 ){ ?>
        <p><a href="index.php?ctrl=forum&action=lockTopic&id=<?= $topic->getId() ?>">Locked</a></p>
    <?php }
    else if((App\Session::getUser() == $topic->getUser() || App\Session::isAdmin()) && $topic->getClosed()==1){?>
        <p><a href="index.php?ctrl=forum&action=lockTopic&id=<?= $topic->getId() ?>">Unlocked</a></p>
        <?php }?>
        <tr>
<?php
foreach($posts as $post ){ ?>
    <td>par <?= $post->getUser() ?> le <?= $post->getcreationDate() ?></td></br>
    <td><?= $post->getText() ?> </td></br></br>
    
<?php }?>
</tr>
</tbody>
<?php 
if(($topic->getClosed() == 0 && App\Session::getUser()) || App\Session::isAdmin()){ ?>
    <h1>nouveau Post</h1>

    <form id="formPrincipal" action="index.php?ctrl=forum&action=addPost&id=<?=$topic->getId()?>" method="post">
        <p>
            <label>
                Post :
                <textarea  name="text"></textarea>
            </label>
        </p>
        <P><input type="submit" value="newPost"></p>
    </form>
<?php }?>
