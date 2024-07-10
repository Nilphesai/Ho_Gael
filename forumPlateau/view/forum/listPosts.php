<?php
    $topic = $result["data"]['topic']; 
    $posts = $result["data"]['posts']; 
    
    if (App\Session::isAdmin() == false && ($topic == false || empty($posts))) {
        // Redirige vers une autre page
        header('Location:./index.php');
    }
?>

<h1>Liste des posts</h1>

    
    <?php 
    if((App\Session::getUser() == $topic->getUser() || App\Session::isAdmin()) && $topic->getClosed()==0 ){ ?>
        <p class=closed><a href="index.php?ctrl=forum&action=lockTopic&id=<?= $topic->getId() ?>">Locked</a></p>
    <?php }
    else if((App\Session::getUser() == $topic->getUser() || App\Session::isAdmin()) && $topic->getClosed()==1){?>
        <p class=closed><a href="index.php?ctrl=forum&action=lockTopic&id=<?= $topic->getId() ?>">Unlocked</a></p>
        <?php }?>

    <tr>
    <?php
    foreach($posts as $post ){ ?>
        <div class='lists'>
        <?php
            if(App\Session::isAdmin() || App\Session::getUser() == $post->getUser()) { ?>
                
                <P><a href='index.php?ctrl=forum&action=deletePost&id=<?=$post->getId() ?>'>delete</a></p>    
                    
            <?php } ?>
        <td>par <?= $post->getUser() ?> le <?= $post->getcreationDate() ?></td></br>
        <td><?= $post->getText() ?> </td></br></br>
        </div>
    <?php }?>
    </tr>


<?php 
if(($topic->getClosed() == 0 && App\Session::getUser()) || App\Session::isAdmin()){ ?>
    <h1>nouveau Post</h1>

    <form id="formAdd" action="index.php?ctrl=forum&action=addPost&id=<?=$topic->getId()?>" method="post">
        <p>
            <label>
                Post :
                <textarea  name="text"></textarea>
            </label>
        </p>
        <P><input type="submit" name="submit" value="submit"></p>
    </form>
<?php }?>
