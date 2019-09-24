<?php
use \P4\model\PostManager;
use \P4\model\CommentManager;
use \P4\model\UserManager;

require_once('model/CommentManager.php');
require_once('model/PostManager.php');
require_once('model/UserManager.php');


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

function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $episode = $postManager->getEpisode($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/postView.php');
}

function addComment($episodeId, $auteur, $comment)
{
    $commentManager = new CommentManager();    
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
    $commentManager = new CommentManager();
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
    $commentManager = new CommentManager();
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
    $commentManager = new CommentManager();
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


function pageInscription()
{
    require('view/inscription.php');
}

function addUser($pseudo, $mdp)
{
    $userManager = new UserManager();
    $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);

    $pseudoUnique = $userManager->testPseudo($pseudo);
    if ($pseudoUnique === false) {
       $ajoutUtilisateur = $userManager->inscription($pseudo, $mdp_hash);

        if($ajoutUtilisateur === false){
            throw new Exception ('Impossible d\'ajouter l\'utilisateur');
        }
        else{
            require('view/compteCréé.php');
        }
    } else {
        throw new Exception ('Ce nom d\'utilisateur est deja pris');
    }
}

function connexion($pseudo, $mdp)
{
    $userManager = new UserManager();
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
