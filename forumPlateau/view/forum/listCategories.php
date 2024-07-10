<?php
    $categories = $result["data"]['categories'];
    if (empty($categories) && App\Session::isAdmin() == false) {
        // Redirige vers une autre page
        header('Location:./index.php');
    }
?>

<h1>Liste des catégories</h1>

    <?php
    foreach($categories as $category ){ ?>
    <div class='lists'>
        <?php
            if(App\Session::isAdmin()) { ?>
                <P><a href='index.php?ctrl=forum&action=deleteCategory&id=<?=$category->getId() ?>'>delete</a>
            <?php } ?>
        <a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>"><?= $category->getName() ?></a></p>
        </div>
    <?php }?>

<?php
if(App\Session::isAdmin()){ ?>
    <h1>nouveau Categorie</h1>

        <form id="formAdd" action="index.php?ctrl=forum&action=addCategory" method="post">
            <p>
                <label>
                    Post :
                    <textarea  name="name"></textarea>
                </label>
            </p>
            <P><input type="submit" name="submit" value="submit"></p>
        </form>
<?php }?>