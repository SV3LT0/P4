<?php $title = "Billet simple pour l'Alaska"; ?>

<?php ob_start(); ?>

<h1>Billet simple pour l'Alaska</h1>

<a href="index.php?action=newepisode"><button>Écrire un nouveau chapitre</button></a><br/>

<h4>Commentaires signalés</h4>
<?php
if(!$commentsReported){ ?>
    <p>Aucun commentaire signalé</p>
<?php
}else{
    while ($commSignale = $commentsReported->fetch())
    {
    ?>
        <p><strong><?= htmlspecialchars($comment['auteur']) ?></strong> le <?= $comment['comment_date'] ?> 
        <a href="index.php?action=deleteComm&amp;id=<?=$comment['id']?>&amp;idEpisode=<?=$comment['idEpisode']?>">Supprimer</a></p>
        <p><?= nl2br(htmlspecialchars($comment['contenu'])) ?></p>
    <?php
    }
}
    ?>

<h3>Derniers chapitres</h3>

<?php 
while ($data = $episodes->fetch())
{
?>
    <div>
        <h3>
            <?= htmlspecialchars($data['titre']) ?>
            <em>le <?=$data['creation_date_fr'] ?></em>
            <a href="index.php?action=modifier&amp;id=<?=$data['id'] ?>">Modifier chapitre</a>
        </h3>

        <p>
            <?= $data['contenu']?>
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