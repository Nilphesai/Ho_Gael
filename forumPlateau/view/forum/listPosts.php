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
        <p class="btn btn-primary" class=closed><a href="index.php?ctrl=forum&action=lockTopic&id=<?= $topic->getId() ?>">Locked</a></p>
    <?php }
    else if((App\Session::getUser() == $topic->getUser() || App\Session::isAdmin()) && $topic->getClosed()==1){?>
        <p class="btn btn-primary" class=closed><a href="index.php?ctrl=forum&action=lockTopic&id=<?= $topic->getId() ?>">Unlocked</a></p>
        <?php }?>
<div class="card text-white bg-primary mb-3" >
    
    <?php
    foreach($posts as $post ){ ?>
        <div class="card-header">
        <?php
            if(App\Session::isAdmin() || App\Session::getUser() == $post->getUser()) { ?>
                
                <P><a href='index.php?ctrl=forum&action=deletePost&id=<?=$post->getId() ?>'>delete</a></p>    
                    
            <?php } ?>
            
        <p class="card-title">par <?= $post->getUser() ?> le <?= $post->getcreationDate() ?></p>
        </div>
        <div class="card-body">
        <p class="card-text"><?= $post->getText() ?> </p>
        </div>
    <?php }?>
    
</div>
<?php 
if(($topic->getClosed() == 0 && App\Session::getUser()) || App\Session::isAdmin()){ ?>
    <div class="card border-primary mb-3" style="max-width: 20rem;">
    <h1 class="card-header">nouveau Post</h1>

    <form class="card-body" id="formAdd" action="index.php?ctrl=forum&action=addPost&id=<?=$topic->getId()?>" method="post">
        <p>
            <label class="form-label mt-4">
                Post :
                <textarea class="form-control" name="text"></textarea>
            </label>
        </p>
        <P><input class="btn btn-primary" type="submit" name="submit" value="submit"></p>
    </form>
    </div>
<?php }?>
