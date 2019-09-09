<?php
require_once('model/CommentManager.php');
require_once('model/PostManager.php');
require_once('model/UserManager.php');

function listEpisodes()
{
    $postManager = new \P4\model\PostManager();
    $commentManager = new \P4\model\CommentManager();

    $episodes = $postManager->getEpisodes();    
    $commentsReported = $commentManager->getCommentsReported();
    $nbCommReport = $commentManager-> countCommReport();

    require('view/listEpisodeView.php');
}

function pageUpdate()
{
    $postManager = new \P4\model\PostManager();

    $episode = $postManager->getEpisode($_GET['id']);
  
    require('view/updateEpisode.php');
}

function updateEpisode($titre, $contenu, $id)
{
    $postManager = new \P4\model\PostManager();
    $updateEpisode = $postManager->modifierEpisode($titre, $contenu, $id);

    if($updateEpisode === false){
        throw new Exception ('Impossible de modifier l\'épisode');
    }
    else{
        header('Location: index.php');
    }
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

function deleteComm($id, $episodeId)
{
    $commentManager = new \P4\model\CommentManager();
    $affectedLines = $commentManager->deleteComment($id);

    if($affectedLines === false){
        throw new Exception('Impossible de supprimer le commentaire');
    }
    else{
        header('Location: index.php?action=post&id=' . $episodeId);
    }
}

function reportComm($id, $episodeId)
{
    $commentManager = new \P4\model\CommentManager();
    $commentSignale = $commentManager->signaleCommentaire($id);

    if($commentSignale === false){
        throw new Exception('Impossible de signaler le commentaire');
    }
    else{
        header('Location: index.php?action=post&id=' . $episodeId);
    }
}

function cancelReport($id)
{
    $commentManager = new \P4\model\CommentManager();
    $annuleSignale = $commentManager->annuleSignale($id);

    if($annuleSignale === false){
        throw new Exception('Impossible d\'annuler le signaler');
    }
    else{
        header('Location: index.php');
    }
}

function pageNewEpisode()
{
    require('view/newEpisode.php');
}

function addNewEpisode($titre, $contenu)
{
    
    $postManager = new \P4\model\PostManager();
    $nouvelEpisode = $postManager->newEpisode($titre, $contenu);

    if($nouvelEpisode === false){
        throw new Exception ('Impossible d\'ajouter l\'épisode');
    }
    else{
        header('Location: index.php');
    }
}


function pageInscription()
{
    require('view/inscription.php');
}

function addUser($pseudo, $mdp)
{
    $userManager = new \P4\model\UserManager();
    $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);

    //$pseudoUnique = $userManager->testPseudo($pseudo);
       $ajoutUtilisateur = $userManager->inscription($pseudo, $mdp_hash);

        if($ajoutUtilisateur === false){
            throw new Exception ('Impossible d\'ajouter l\'utilisateur');
        }
        else{
            header('Location: index.php');
        }
}

function connexion($pseudo, $mdp)
{
    $userManager = new \P4\model\UserManager();
    $connexionUtilisateur = $userManager->connexionUtilisateur($pseudo, $mdp);

    $passwordCorrect = password_verify($mdp, $connexionUtilisateur['mdp']);

    if (!$connexionUtilisateur){
        echo 'Mauvais identifiant ou mot de passe !';
    } elseif ($passwordCorrect) {
        session_start();
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['isAdmin'] = $connexionUtilisateur['isAdmin'];
        header('Location: index.php');
    } else {
        echo 'Mauvais identifiant ou mot de passe !';
    }
}

function déconnexion()
{
    session_start();
    $_SESSION = array();
    session_destroy();
    header('Location: index.php');
}
