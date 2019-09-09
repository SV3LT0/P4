<?php $title = "Billet simple pour l'Alaska"; ?>
<?php session_start(); ?>
<?php ob_start(); ?>

<h1>Billet simple pour l'Alaska</h1>

<p><a href="index.php">Retour</a></p>

<h3>Modification du chapitre</h3>

<form action= "index.php?action=update&amp;id=<?=$episode['id']?>" method="post">
    <label for="titre">Titre</label>
    <input type="text" name="titre" id="titre" value='<?=$episode['titre']?>'/><br>
    <label for="contenu"></label>
    <textarea name="contenu" id="mytextarea"><?=$episode['contenu']?></textarea><br>
    <input class="btn btn-light" type="submit"/>
</form>

<?php $content = ob_get_clean();?>

<?php require('template.php'); ?>