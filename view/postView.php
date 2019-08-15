<?php $title = htmlspecialchars($episode['title']); ?>

<?php ob_start(); ?>
<h1>Billet simple pour l'Alaska</h1>
<p><a href="index.php">Retour</a></p>

<div>
    <h2>
        <?= htmlspecialchars($episode['title'])?>
        <em>le <?= post['creation_date_fr']?></em>
    </h2>

    <p>
        <?= nl2br(htmlspecialchars($episode['contenu'])) ?>
    </p>
</div>

<h3>Commentaires</h3>

<?php 
while ($comments = $comments->fetch())
{
?>
    <p><strong><?htmlspecialchars($comments['auteur']) ?></strong> le <?= $comments['comment_date'] ?></p>
    <p><?= nl2br(htmlspecialchars($comments['contenu'])) ?></p>
<?php
}
?>

<?php $content = ob_get_clean();?>

<?php require('template.php'); ?>