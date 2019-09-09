<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="public/css/style.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
    tinymce.init({
    selector: '#mytextarea'
  });
  </script>
    </head>

    <body>
            <?php
                if(isset($_SESSION['pseudo'])){ ?>
                    <p>Bonjour <?php echo $_SESSION['pseudo'];?>
                    <a href="index.php?action=deconnexion"><button type="button" class="btn btn-light">Déconnexion</button></a></p>
                <?php
                } elseif (!isset($_GET['action']) or $_GET['action']!='inscription'){
                ?>
                    <form action= "index.php?action=connexion" method="post">
                        <label for='pseudo'> Pseudo </label>
                        <input type='text' name='pseudo' id='pseudo'/><br/>
                        <label for='mdp'>Mot de Passe</label>
                        <input type='password'name='mdp' id='mdp'/><br/>
                        <input class="btn btn-light" type='submit' value="Connexion"/><br/>
                    </form>
                    <a href="index.php?action=inscription"><button type="button" class="btn btn-light">Inscription</button></a><br/>
                    <?php
                } ?>

        <?= $content ?>
    </body>
</html>