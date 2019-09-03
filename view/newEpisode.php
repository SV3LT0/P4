<?php $title = "Billet simple pour l'Alaska"; ?>

<?php ob_start(); ?>

<h1>Billet simple pour l'Alaska</h1>

<p><a href="index.php">Retour</a></p>

<h3>Ecriture d'un nouvel épisode</h3>

<form method="post" action="index.php?action=addepisode">
<label for="titre">Titre</label>
<input type="text" name="titre" id="titre" required><br>
<label for="contenu"></label>
<textarea name="contenu" id="mytextarea" placeholder ="Ecrire le contenu du chapitre" required></textarea><br>
<input type="submit" value="Publier">
</form>

<?php $content = ob_get_clean();?>

<?php require('template.php'); ?>
