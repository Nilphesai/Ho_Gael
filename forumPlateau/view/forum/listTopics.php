<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des topics</h1>

<?php
foreach($topics as $topic ){ ?>
    <p><a href="index.php?ctrl=forum&action=listPostsByTopics&id=<?= $topic->getId() ?>"><?= $topic ?></a> par <?= $topic->getUser() ?></p>
<?php }?>

<h1>nouveau Topic</h1>

    <form id="formPrincipal" action="index.php?ctrl=forum&action=addTopic" method="post">
        <p>
            <label>
                Pseudo :
                <input type="text" name="title">
            </label>
        </p>
        <P><input type="submit" value="newTopic"></p>
    </form>