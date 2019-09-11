<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <meta name="viewport" content="width=device-width" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="public/style.css" rel="stylesheet" />
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
    tinymce.init({
    selector: '#mytextarea'
  });
  </script>
    </head>

    <body>
        <header id='header'>
            <h1>Billet Simple Pour l'Alaska</h1>
                <?php
                    if(isset($_SESSION['pseudo'])){ ?>
                        <div class='compte'>
                            <p>Bonjour <?php echo $_SESSION['pseudo'];?>
                            <a href="index.php?action=deconnexion"><button type="button" class="btn btn-dark">Déconnexion</button></a></p>
                        </div>    
                    <?php
                    } elseif (!isset($_GET['action']) or $_GET['action']!='inscription'){
                    ?>
                        <div class='compte'>
                            <form action= "index.php?action=connexion" method="post">
                                <label for='pseudo'> Pseudo </label>
                                <input type='text' name='pseudo' id='pseudo'/><br/>
                                <label for='mdp'>Mot de Passe</label>
                                <input type='password'name='mdp' id='mdp'/><br/>                
                                <input class="btn btn-dark" type='submit' value="Connexion"/>
                                <a href="index.php?action=inscription"><button type="button" class="btn btn-dark">Inscription</button></a><br/>     
                            </form>
                            
                        </div>
                        <?php
                    } ?>
        </header>
        <section>
            <?= $content ?>
        </section>
    </body>
</html>