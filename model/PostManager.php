<?php

namespace P4\model;

require_once("model/Manager.php");

class PostManager extends Manager
{
    public function getEpisodes()
    {
        $db = $this->dbConnect();
        $req = $db ->query('SELECT id, titre, contenu, DATE_FORMAT(creation_date, "%d/%m/%Y")AS creation_date_fr FROM episode ORDER BY numeroChapitre DESC');

        return $req;
    }

    public function getEpisode($episodeId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, titre, contenu, numeroChapitre, DATE_FORMAT(creation_date, "%d/%m/%Y")AS creation_date_fr FROM episode WHERE id = ?');
        $req->execute(array($episodeId));
        $episode = $req->fetch();

        return $episode;
    }

    public function newEpisode($titre, $contenu, $numeroChapitre)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO episode(titre, contenu, creation_date, numeroChapitre)VALUES(:titre,:contenu,CURDATE(),:numeroChapitre)');
        $nouvelEpisode = $req->execute(array('titre'=>$titre, 'contenu'=>$contenu, 'numeroChapitre'=>$numeroChapitre));
        
        return $nouvelEpisode;
    }

    public function modifierEpisode($titre, $contenu, $id, $numeroChapitre)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE episode SET titre=:titre, contenu=:contenu, creation_date=CURDATE(), numeroChapitre=:numeroChapitre WHERE id=:id');
        $updateEpisode = $req->execute(array('titre'=>$titre, 'contenu'=>$contenu, 'numeroChapitre'=>$numeroChapitre, 'id'=>$id));
        
        return $updateEpisode;
    }

    public function deletEpisode($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM episode WHERE id = :id');
        $deleteEpisode = $req->execute(array('id'=>$id));

        return $deleteEpisode;
    }
}

?>