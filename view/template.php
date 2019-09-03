<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="public/css/style.css" rel="stylesheet" /> 
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
    tinymce.init({
    selector: '#mytextarea'
  });
  </script>
    </head>

    <body>
            <?php
                if(isset($_SESSION['id'])) { ?>
                    <p>Bonjour <?php htmlspecialchars($_SESSION['pseudo']);?></p>
                <?php
                } elseif(isset($_GET['action']) && $_GET['action']=='inscription'){
                    ?><p></p><?php
                }else{
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