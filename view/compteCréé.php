<?php $title = 'Confirmation'; ?>
<?php $connexion ='';?>

<?php ob_start(); ?>

<p><a class="link" href="index.php">Retour</a><br>
Votre compte a bien été créé !</p>



<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>