<?php

use \P4\model\UserManager;

require_once('model/UserManager.php');


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
