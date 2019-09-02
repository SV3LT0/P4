<?php


function addUser($pseudo, $mdp_hach)
{
    $db = dbConnect();

    $req = $db->prepare('INSERT INTO utilisateur(pseudo, mdp, isAdmin) VALUES (:pseudo,:mdp, 0)');
    $ajoutUtilisateur = $req->execute(array(
        'pseudo'=>$pseudo,
        'mdp'=>$mdp_hach));

    return $ajoutUtilisateur;
}