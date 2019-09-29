<?php

use \P4\model\PostManager;
use \P4\model\CommentManager;

require_once('model/CommentManager.php');
require_once('model/PostManager.php');


function listEpisodes()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $episodes = $postManager->getEpisodes();    
    $commentsReported = $commentManager->getCommentsReported();
    $nbCommReport = $commentManager-> countCommReport();

    require('view/listEpisodeView.php');
}

function pageUpdate()
{
    $postManager = new PostManager();

    $episode = $postManager->getEpisode($_GET['id']);
  
    require('view/updateEpisode.php');
}

function supprimerEpisode($idEpisode)
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $deleteEpisode = $postManager->deletEpisode($idEpisode);
    $deleteCommEp = $commentManager-> deleteCommEp($idEpisode);

    header('Location: index.php');
}

function updateEpisode($titre, $contenu, $id, $numeroChapitre)
{
    $postManager = new PostManager();
    $updateEpisode = $postManager->modifierEpisode($titre, $contenu, $id, $numeroChapitre);

    if($updateEpisode === false){
        throw new Exception ('Impossible de modifier l\'épisode');
    }
    else{
        header('Location: index.php');
    }
}

function pageNewEpisode()
{
    require('view/newEpisode.php');
}

function addNewEpisode($titre, $contenu, $numeroChapitre)
{
    
    $postManager = new PostManager();
    $nouvelEpisode = $postManager->newEpisode($titre, $contenu, $numeroChapitre);

    if($nouvelEpisode === false){
        throw new Exception ('Impossible d\'ajouter l\'épisode');
    }
    else{
        header('Location: index.php');
    }
}
