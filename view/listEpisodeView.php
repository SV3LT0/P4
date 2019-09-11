<?php $title = "Billet simple pour l'Alaska"; ?>
<?php session_start(); ?>
<?php ob_start(); ?>

<?php 
if (isset($_SESSION['isAdmin']) and $_SESSION['isAdmin']==1) { ?>
    <a href="index.php?action=newEpisode"><button type="button" class="btn btn-dark">Écrire un nouveau chapitre</button></a><br/>
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
<?php
}
?>
<h2 id="derniersChapitres">Derniers chapitres</h2>

<?php 
while ($data = $episodes->fetch())
{
?>
    <div>
        <h3>
            <?= htmlspecialchars($data['titre']) ?>
            <em>le <?=$data['creation_date_fr'] ?></em>
            <?php 
            if (isset($_SESSION['isAdmin']) and $_SESSION['isAdmin']==1) { ?>
            <a class="link" href="index.php?action=modifier&amp;id=<?=$data['id'] ?>">Modifier chapitre</a>
            <?php 
            } 
            ?>
        </h3>

        <p>
            <?= $data['contenu']?>
            <br/>
            <a class="link" href="index.php?action=post&amp;id=<?=$data['id'] ?>">Commentaires</a>
        </p>
    </div>
<?php
}
$episodes->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>