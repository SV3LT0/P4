<?php

namespace P4\model;

require_once("model/Manager.php");

class PostManager extends Manager
{
    public function getEpisodes()
    {
        $db = $this->dbConnect();
        $req = $db ->query('SELECT id, titre, contenu, DATE_FORMAT(creation_date, "%d/%m/%Y")AS creation_date_fr FROM episode ORDER BY creation_date DESC');

        return $req;
    }


    public function getEpisode($episodeId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, titre, contenu, DATE_FORMAT(creation_date, "%d/%m/%Y")AS creation_date_fr FROM episode WHERE id = ?');
        $req->execute(array($episodeId));
        $episode = $req->fetch();

        return $episode;
    }

    public function newEpisode($titre, $contenu)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO episode(titre, contenu, creation_date)VALUES(:titre,:contenu,CURDATE())');
        $nouveauEpisode = $req->execute(array('titre'=>$titre, 'contenu'=>$contenu));
        
        return $nouveauEpisode;
    }
}

?>