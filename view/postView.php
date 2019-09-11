<?php $title = htmlspecialchars($episode['titre']); ?>
<?php session_start(); ?>
<?php ob_start(); ?>
<p><a href="index.php">Retour</a></p>

<div>
    <h2>
        <?= htmlspecialchars($episode['titre'])?>
        <em>le <?= $episode['creation_date_fr']?></em>
    </h2>

    <p>
        <?=$episode['contenu'] ?>
    </p>
</div>

<h3>Commentaires</h3>

<form action= "index.php?action=addComment&amp;id=<?=$episode['id']?>" method="post">
    <?php
    if(isset($_SESSION['pseudo'])){
        $_POST['auteur'] = $_SESSION['pseudo'];
    }else{?> 
        <div>
            <label for="auteur">Pseudo</label><br/>
            <input type="text" id="auteur" name="auteur" />
        </div>
        <?php
    }
        ?>
    <div>
        <label for="commentaire">Commentaire</label><br/>
        <textarea id="commentaire" name="commentaire"></textarea>
    </div>
    <div>
        <input class="btn btn-light" type="submit"/>
    </div>
</form>

<?php 
while ($comment = $comments->fetch())
{
?>
    <p><strong><?= htmlspecialchars($comment['auteur']) ?></strong> le <?= $comment['comment_date'] ?>
    <a href="index.php?action=reportComm&amp;id=<?=$comment['id']?>&amp;idEpisode=<?=$comment['idEpisode']?>">Signaler</a>
    <?php 
    if (isset($_SESSION['isAdmin']) and $_SESSION['isAdmin']==1) { ?>
    <a href="index.php?action=deleteComm&amp;id=<?=$comment['id']?>&amp;idEpisode=<?=$comment['idEpisode']?>">Supprimer</a></p>
    <?php
    }
    ?>
    <p><?= nl2br(htmlspecialchars($comment['contenu'])) ?></p>
<?php
}
$comments->closeCursor();
?>

<?php $content = ob_get_clean();?>

<?php require('template.php'); ?>