<?php $title = "Billet simple pour l'Alaska"; ?>

<?php ob_start(); ?>

<h1>Billet simple pour l'Alaska</h1>

<a href="index.php?action=newepisode"><button>Écrire un nouveau chapitre</button></a><br/>

<h4>Commentaires signalés</h4>
<?php
if($nbCommReport>0){
    while($commSignale = $commentsReported->fetch())
    {
        ?>
        <div id="commSignale">
            <p><strong><?= htmlspecialchars($commSignale['auteur']) ?></strong> le <?= $commSignale['comment_date'] ?> 
            <a href="index.php?action=deleteComm&amp;id=<?=$commSignale['id']?>&amp;idEpisode=<?=$commSignale['idEpisode']?>">Supprimer</a>
            <a href="index.php?action=cancelReport&amp;id=<?=$commSignale['id']?>">Retirer le signalement</a></p>
            <p><?= nl2br(htmlspecialchars($commSignale['contenu'])) ?></p>
        </div>
    <?php
    }
} else { ?>
    <p>Aucun commentaire signalé</p>
<?php
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