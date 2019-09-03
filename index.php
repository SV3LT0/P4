<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('controller/frontend.php');

try {
    if(isset($_GET['action'])){
        if($_GET['action'] == 'listEpisodes'){
            listEpisodes();
        }
        elseif($_GET['action'] == 'post'){
            if(isset($_GET['id']) && $_GET['id']>0){
                post();
            }
            else {
                throw new Exception('Aucun identifiant d\'épisode envoyé');
            }
        }
        elseif($_GET['action']=='addComment'){
            if(isset($_GET['id']) && $_GET['id']>0){
                addComment($_GET['id'],$_POST['auteur'],$_POST['commentaire']);
            }
            else{
                throw new Exception('Tous les champs ne sont pas remplis');
            }
        }
        elseif($_GET['action']=='inscription'){
            pageInscription();
        }
        elseif($_GET['action']=='adduser'){
            if(!preg_match('#^(?=.*[a-z])(?=.*[0-9])#',$_POST['mdp'])){
                throw new Exception('Mot de passe non conforme');
            }
            elseif($_POST['mdp']!=$_POST['verifMdp']) {
                throw new Exception('Les deux mot de passe ne correspondent pas');
            }
            else{
                inscription($_POST['pseudo'],$_POST['mdp']);
            }
        }
        elseif($_GET['action']='newepisode'){
            pageNewEpisode();
        }
        elseif($_GET['action']='addepisode'){   
            addNewEpisode($_POST['titre'],$_POST['contenu']);
        }
        elseif($_GET['action']='deleteComm'){
            if(isset($_GET['id']) && $_GET['id']>0){
                deleteComm($_GET['id'],$_GET['idEpisode']);
            }
            else {
                throw new Exception('Ce commentaire n\'existe pas');
            }
        }
        
    }
    else{
        listEpisodes();
    }
}
catch(Exception $e){
    echo 'Erreur : '. $e->getMessage();
}
