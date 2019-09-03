<?php $title = "Billet simple pour l'Alaska"; ?>

<?php ob_start(); ?>

<h1>Billet simple pour l'Alaska</h1>
<p>Derniers épisodes</p>

<a href="index.php?action=newepisode"><button>Écrire un nouveau chapitre</button></a><br/>

<?php 
while ($data = $episodes->fetch())
{
?>
    <div>
        <h3>
            <?= htmlspecialchars($data['titre']) ?>
            <em>le <?=$data['creation_date_fr'] ?></em>
        </h3>

        <p>
            <?= nl2br(htmlspecialchars($data['contenu']))?>
            <br/>
            <a href="index.php?action=post&amp;id=<?=$data['id'] ?>">Commentaires</a>
        </p>
    </div>
<?php
}
$episodes->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>