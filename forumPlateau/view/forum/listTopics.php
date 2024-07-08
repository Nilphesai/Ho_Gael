<?php
    $listCategories = $result["data"]["listCategories"];
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des topics de <?= $category->getName() ?></h1>

<?php
if(isset($topics)){

    //création d'une table, pour garder les valeurs plutôt que d'avoir des constructeurs
    $tab=[];
    foreach ($listCategories as $cat) {
        # code...
        $tab[] = [
            "id" => $cat->getId(),
            "name" => $cat->getName()
        ];
    }

    foreach($topics as $topic){ ?>
        
        <p><a href="index.php?ctrl=forum&action=listPostsByTopics&id=<?= $topic->getId() ?>"><?= $topic ?></a> par <?= $topic->getUser() ?> le <?= $topic->getcreationDate() ?>
        <?php

        

        //liste des catégories
        if(App\Session::isAdmin()) { ?>
            <label for="Category-select">move Topic :</label>
            <select name="listCategory" id="Category-select"<?=$topic->getId()?>>
            <option value="">--Please choose an option--</option>
            <?php
                foreach($tab as $categ) { ?>
                    <option value=<?=$categ["id"]?><?= $topic->getId() ?>><?=$categ["name"]?></option>      
            
            <?php ;}?>
                </select>
        <?php } ?>

        
        
    </p>
    
    <?php }
} else{
    echo "pas de topics";
}?>

<?php 
if((App\Session::isAdmin() || ($category->getId() != 1 && $category->getId() != 3)) && App\Session::getUser()){ ?>
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