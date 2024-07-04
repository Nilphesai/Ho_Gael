<?php
    $topic = $result["data"]['topic']; 
    $posts = $result["data"]['posts']; 
?>

<h1>Liste des posts</h1>

    <tbody>
<tr>
<?php
foreach($posts as $post ){ ?>
    <td>par <?= $post->getUser() ?></td></br>
    <td><?= $post->getText() ?> </td></br></br>
    
<?php }?>
</tr>
</tbody>