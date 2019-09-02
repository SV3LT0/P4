<?php

namespace P4\model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($episodeId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, auteur, contenu, DATE_FORMAT(dateComm, "%d/%m/%Y à %Hh%imin%ss")AS comment_date FROM commentaire WHERE idEpisode = ? ORDER BY dateComm DESC');
        $comments->execute(array($episodeId));
    
        return $comments;
    }
    
    public function postComment($episodeId, $auteur, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO commentaire(idEpisode, auteur, contenu, dateComm)VALUES(?,?,?,NOW())');
        $affectedLines = $comments->execute(array($episodeId, $auteur, $comment));
    
        return $affectedLines;
    }

}

?>