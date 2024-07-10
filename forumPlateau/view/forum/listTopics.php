<?php
    $listCategories = $result["data"]["listCategories"];
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics'];

    if (($category == false || empty($topics)) && App\Session::isAdmin() == false) {
        // Redirige vers une autre page
        header('Location:./index.php');
    }
?>

<h1>Liste des topics</h1>


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
            <div class='lists'>
            <p><a href="index.php?ctrl=forum&action=listPostsByTopics&id=<?= $topic->getId() ?>"><?= $topic ?></a> par <?= $topic->getUser() ?> le <?= $topic->getcreationDate() ?></p>
            <?php

            //liste des catégories
            if(App\Session::isAdmin()) { ?>
                <form id="formMove" action="index.php?ctrl=forum&action=moveTopic&id=<?=$topic->getId()?>" method="post">
                <label for="Category-select">move Topic :</label>
                <select name="category" id="Category-select"<?=$topic->getId()?>>
                <option value="">--Please choose an option--</option>
                <?php
                    foreach($tab as $categ) { ?>
                        <option value=<?=$categ["id"]?>><?=$categ["name"]?></option>      
                        
                <?php ;}?>
                <input type="submit" name ="submit" value="move"> 
                </select>
                    </form>
            <?php } ?>
            <?php
            if(App\Session::isAdmin() || App\Session::getUser() == $topic->getUser()) { ?>
                
                <p><a href='index.php?ctrl=forum&action=deleteTopics&id=<?=$topic->getId()?>'>delete</a>  </p> 
                    
            <?php } ?>
                
            </div>
        <?php }
    } else{
        echo "pas de topics";
    }?>

<?php 
if((App\Session::isAdmin() || ($category->getId() != 1 && $category->getId() != 3)) && App\Session::getUser()){ ?>
    <h1>nouveau Topic</h1>

        <form id="formAdd" action="index.php?ctrl=forum&action=addTopic&id=<?=$category->getId()?>" method="post">
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
            <P><input type="submit" name ="submit" value="submit"></p>
        </form>
<?php }?>