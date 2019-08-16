<?php $title = htmlspecialchars($episode['titre']); ?>

<?php ob_start(); ?>
<h1>Billet simple pour l'Alaska</h1>
<p><a href="index.php">Retour</a></p>

<div>
    <h2>
        <?= htmlspecialchars($episode['titre'])?>
        <em>le <?= $episode['creation_date_fr']?></em>
    </h2>

    <p>
        <?= nl2br(htmlspecialchars($episode['contenu'])) ?>
    </p>
</div>

<h3>Commentaires</h3>

<?php 
while ($comment = $comments->fetch())
{
?>
    <p><strong><?= htmlspecialchars($comment['auteur']) ?></strong> le <?= $comment['comment_date'] ?></p>
    <p><?= nl2br(htmlspecialchars($comment['contenu'])) ?></p>
<?php
}
$comments->closeCursor();
?>

<?php $content = ob_get_clean();?>

<?php require('template.php'); ?>