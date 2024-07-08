<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des topics de <?= $category->getName() ?></h1>

<?php
if(isset($topics)){
    foreach($topics as $topic){ ?>
        <p><a href="index.php?ctrl=forum&action=listPostsByTopics&id=<?= $topic->getId() ?>"><?= $topic ?></a> par <?= $topic->getUser() ?> le <?= $topic->getcreationDate() ?></p>
    <?php }
} else{
    echo " pas de topics";
}?>

<?php 
if($category->getId() != 1 && $category->getId() != 3 || App\Session::isAdmin()){ ?>
    <h1>nouveau Topic</h1>

        <form id="formPrincipal" action="index.php?ctrl=forum&action=addTopic&id=<?=$category->getId()?>" method="post">
            <p>
                <label>
                    titre :
                    <input type="text" name="title">
                </label>
            </p>
            <p>
                <label>
                    Post :
                    <textarea  name="text"></textarea>
                </label>
            </p>
            <P><input type="submit" value="newTopic"></p>
        </form>
<?php }?>