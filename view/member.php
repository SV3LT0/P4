<?php ob_start(); ?>

<?php
if(isset($_SESSION['id'])) { 
    echo 'Bonjour ' . $_SESSION['pseudo']; 
} else {
    ?>
        <form action= "index.php?action=connexion" method="post">
            <label for='pseudo'> Pseudo </label>
            <input type='text' name='pseudo' id='pseudo'/>
            <label for='mdp'>Mot de Passe</label>
            <input type='password'name='mdp' id='mdp'/>
            <input type='submit' value="Connexion"/>
        </form>
        <form action="index.php$action=inscription" method="post">
            <input type='sumbit' value='Inscription'/>
        </form>
    <?php
} ?>

<?php $connexion = ob_get_clean(); ?>

<?php require('template.php'); ?>