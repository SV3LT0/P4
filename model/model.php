<?php
function getEpisodes()
{
    $db = dbConnect();
    $req = $db ->query('SELECT id, titre, contenu, DATE_FORMAT(creation_date, "%d/%m/%Y")AS creation_date_fr FROM episode ORDER BY creation_date ');

    return $req;
}

function dbConnect()
{
    $db = new PDO('mysql:host=localhost;dbname=p4;charset=utf8', 'root', '');
    return $db;
}

function getEpisode($episodeId)
{
    $db = dbConnect();
    $req = $db->prepare('SELECT id, titre, contenu, DATE_FORMAT(creation_date, "%d/%m/%Y")AS creation_date_fr FROM episode WHERE id = ?');
    $req->execute(array($episodeId));
    $episode = $req->fetch();

    return $episode;
}

function getComments($episodeId)
{
    $db = dbConnect();
    $comments = $db->prepare('SELECT id, auteur, contenu, DATE_FORMAT(dateComm, "%d/%m/%Y à %Hh%imin%ss")AS comment_date FROM commentaire WHERE idEpisode = ? ORDER BY dateComm DESC');
    $comments->execute(array($episodeId));
    
    return $comments;
}

function postComment($episodeId, $auteur, $comment)
{
    $db = dbConnect();
    $comments = $db->prepare('INSERT INTO commentaire(idEpisode, auteur, contenu, dateComm)VALUES(?,?,?,NOW())');
    $affectedLines = $comments->execute(array($episodeId, $auteur, $comment));

    return $affectedLines;
}

function addUser($pseudo, $mdp){
    $mdp_hach = password_hash($mdp, PASSWORD_DEFAULT);

    $db = dbConnect();

    $req = $db->prepare('INSERT INTO utilisateur(pseudo, mdp, isAdmin) VALUES (:pseudo, :mdp, 0)');
    $affectedLines = $req->execute(array(
        'pseudo'=>$pseudo,
        'mdp'=> $mdp_hach));
}