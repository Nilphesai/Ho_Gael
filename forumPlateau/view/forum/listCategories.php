<?php
    $categories = $result["data"]['categories'];
    if (empty($categories) && App\Session::isAdmin() == false) {
        // Redirige vers une autre page
        header('Location:./index.php');
    }
?>
<div class="jumbotron">
    <h1 class="display-3">Liste des catégories</h1>

        <?php
        foreach($categories as $category ){ ?>
        <div class="card text-white bg-primary mb-3">
            <?php
                if(App\Session::isAdmin()) { ?>
                    <P class="card-header"><a href='index.php?ctrl=forum&action=deleteCategory&id=<?=$category->getId() ?>'>delete</a></p>
                <?php } ?>
            <p><a class="card-title" href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>"><?= $category->getName() ?></a></p>
            </div>
        <?php }?>

    <?php
    if(App\Session::isAdmin()){ ?>
    <div class="card border-primary mb-3" style="max-width: 22rem;">
        <h1 class="card-header">nouvelle Categorie</h1>
            <form class="card-body" id="formAdd" action="index.php?ctrl=forum&action=addCategory" method="post">
                <p class="lead">
                    <label class="form-label mt-4">
                    titre :
                    <input class="form-control" type="text" name="title">
                    </label>
                </p>
                <P><input class="btn btn-primary" type="submit" name="submit" value="submit"></p>
            </form>
    </div>
    <?php }?>
</div>