<?php
require('model/model.php');

function listEpisodes()
{
    $episodes = getEpisodes();
    require('view/listEpisodeView.php');   
}

function post()
{
    $episode = getEpisode($_GET['id']);
    $comments = getComments($_GET['id']);

    require('view/postView.php');
}

function addComment($episodeId, $auteur, $comment)
{
    $affectedLines = postComment($episodeId, $auteur, $comment);

    if($affectedLines === false){
        throw new Exception('Impossible d\'ajouter le commentaire');
    }
    else{
        header('Location: index.php?action=post&id=' . $episodeId);
    }
}