<?php
    $topic = $result["data"]['topic']; 
    $posts = $result["data"]['posts']; 
?>

<h1>Liste des posts</h1>

    <tbody>
<tr>
<?php
foreach($posts as $post ){ ?>
    <td>par <?= $post->getUser() ?> le <?= $post->getcreationDate() ?></td></br>
    <td><?= $post->getText() ?> </td></br></br>
    
<?php }?>
</tr>
</tbody>

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