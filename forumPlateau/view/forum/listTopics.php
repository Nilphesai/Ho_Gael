<?php
    $listCategories = $result["data"]["listCategories"];
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des topics de <?= $category->getName() ?></h1>

<?php
if(isset($topics)){
    foreach($topics as $topic){ ?>
        
        <p><a href="index.php?ctrl=forum&action=listPostsByTopics&id=<?= $topic->getId() ?>"><?= $topic ?></a> par <?= $topic->getUser() ?> le <?= $topic->getcreationDate() ?>
        <?php
        //var_dump("ping"); die;
        if(App\Session::isAdmin()) { ?>
            <label for="Category-select">move Topic :</label>

            <select name="listCategory" id="Category-select"<?=$topic->getId()?>>
            <option value="">--Please choose an option--</option>
            <?php
            
            //var_dump($categ); die;
                //ne se parcours qu'une fois puis se ferme
                foreach($listCategories as $categ) { 
                    var_dump($categ);?>
                        
                        <option value=<?=$categ->getId()?><?= $topic->getId() ?>><?=$categ->getName()?></option>      
            <?php } ?>
                </select>
        <?php } ?>

        
        
    </p>
    
    <?php }
} else{
    echo "pas de topics";
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