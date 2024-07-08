<?php
    $categories = $result["data"]['categories']; 
?>

<h1>Liste des catégories</h1>

<?php
foreach($categories as $category ){ ?>
    <p><a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>"><?= $category->getName() ?></a></p>
<?php }?>
<?php
if(App\Session::isAdmin()){ ?>
    <h1>nouveau Categorie</h1>

        <form id="formPrincipal" action="index.php?ctrl=forum&action=addCategory" method="post">
            <p>
                <label>
                    Post :
                    <textarea  name="name"></textarea>
                </label>
            </p>
            <P><input type="submit" value="newPost"></p>
        </form>
<?php }?>