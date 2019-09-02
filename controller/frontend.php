<?php
require_once('model/CommentManager.php');
require_once('model/PostManager.php');


function listEpisodes()
{
    $postManager = new \P4\model\PostManager();

    $episodes = $postManager->getEpisodes();
  
    require('view/listEpisodeView.php');
}

function post()
{
    $postManager = new \P4\model\PostManager();
    $commentManager = new \P4\model\CommentManager();

    $episode = $postManager->getEpisode($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/postView.php');
}

function addComment($episodeId, $auteur, $comment)
{
    $commentManager = new \P4\model\CommentManager();    

    $affectedLines = $commentManager->postComment($episodeId, $auteur, $comment);

    if($affectedLines === false){
        throw new Exception('Impossible d\'ajouter le commentaire');
    }
    else{
        header('Location: index.php?action=post&id=' . $episodeId);
    }
}

function pageInscription()
{
    require('view/inscription.php');
}

function inscription($pseudo, $mdp)
{
    $mdp_hach = password_hash($mdp, PASSWORD_DEFAULT);
    $ajoutUtilisateur = addUser($pseudo, $mdp_hach);

    if($ajoutUtilisateur === false){
        throw new Exception ('Impossible d\'ajouter l\'utilisateur');
    }
    else{
        header('Location: index.php');
    }

    require('view/inscription.php');
}