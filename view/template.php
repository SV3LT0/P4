<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="public/css/style.css" rel="stylesheet" /> 
    </head>

    <body>
            <?php
                if(isset($_SESSION['id'])) { 
                    echo 'Bonjour ' . $_SESSION['pseudo']; 
                } else {
            ?>
                <form action= "index.php?action=connexion" method="post">
                    <label for='pseudo'> Pseudo </label>
                    <input type='text' name='pseudo' id='pseudo'/><br/>
                    <label for='mdp'>Mot de Passe</label>
                    <input type='password'name='mdp' id='mdp'/><br/>
                    <input type='submit' value="Connexion"/><br/>
                </form>
                <a href="index.php?action=inscription"><button>Inscription</button></a><br/>
            <?php
            } ?>

        <?= $content ?>
    </body>
</html>