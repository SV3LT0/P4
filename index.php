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
    }
    else{
        listEpisodes();
    }
}
catch(Exception $e){
    echo 'Erreur : '. $e->getMessages();
}
