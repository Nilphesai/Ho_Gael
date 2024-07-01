<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    <title><?= $title ?></title>
</head>
<body>
    <div id="wrapper" class="uk-container uk-container-expand">
        <nav>
            <ul>
                <li><a href="index.php?action=listFilms">Films</a></li>
                <li><a href="index.php?action=listGenres">Genres</a></li>
                <li><a href="index.php?action=listActeurs">Acteurs</a></li>
                <li><a href="index.php?action=listRealisateurs">Realisateurs</a></li>
            </ul>
        </nav>

        
        <main>
            <div id="contenu">
            <h1 class="uk-heading-divider">PDO Cinema</h1>
            <h2 class="uk-heading-bullet"><?= $titre_secondaire ?></h2>
            <?= $contenu ?>
            </div>
        </main>
    </div>
</body>
</html>