<?php
    $listCategories = $result["data"]["listCategories"];
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics'];

    if (($category == false || empty($topics)) && App\Session::isAdmin() == false) {
        // Redirige vers une autre page
        header('Location:./index.php');
    }
?>

<h1 class="display-3">Liste des topics</h1>


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
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">
                    <p><a href="index.php?ctrl=forum&action=listPostsByTopics&id=<?= $topic->getId() ?>"><?= $topic ?></a> par <?= $topic->getUser() ?> le <?= $topic->getcreationDate() ?></p>
                </div>
                <?php
                
                //liste des catégories
                if(App\Session::isAdmin()) { ?>
                    <div class="card-body">
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
                    </div>  
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
    <div class="card border-primary mb-3" style="max-width: 20rem;">
    <h1 class="card-header">nouveau Topic</h1>

        <form class="card-body" id="formAdd" action="index.php?ctrl=forum&action=addTopic&id=<?=$category->getId()?>" method="post">
            <p>
                <label class="form-label mt-4">
                    titre :
                    <input class="form-control" type="text" name="title">
                </label>
            </p>
            <p>
                <label class="form-label mt-4">
                    Post :
                    <textarea class="form-control" name="text"></textarea>
                </label>
            </p>
            <P><input class="btn btn-primary" type="submit" name ="submit" value="submit"></p>
        </form>
<?php }?>