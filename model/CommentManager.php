<?php

namespace P4\model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($episodeId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, auteur, contenu, idEpisode, signale, DATE_FORMAT(dateComm, "%d/%m/%Y à %Hh%imin%ss")AS comment_date FROM commentaire WHERE idEpisode = ? ORDER BY dateComm DESC');
        $comments->execute(array($episodeId));
    
        return $comments;
    }
    
    public function postComment($episodeId, $auteur, $comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO commentaire(idEpisode, auteur, contenu, dateComm, signale)VALUES(:idEpisode,:auteur,:contenu,NOW(),0)');
        $affectedLines = $req->execute(array('idEpisode'=>$episodeId,'auteur'=>$auteur,'contenu'=>$comment));
    
        return $affectedLines;
    }

    public function deleteComment($id)
    {
        $db = $this->dbConnect();
        $deleteComment = $db->prepare('DELETE FROM commentaire WHERE id=:id');
        $affectedLines = $deleteComment->execute(array('id'=>$id));

        return $affectedLines;
    }

    public function signaleCommentaire($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE commentaire SET signale=1 WHERE id=:id');
        $commentSignale = $req->execute(array('id'=>$id));

        return $commentSignale;
    }
    
    public function getCommentsReported()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, auteur, contenu, idEpisode, signale, DATE_FORMAT(dateComm, "%d/%m/%Y à %Hh%imin%ss")AS comment_date FROM commentaire WHERE signale = 1');
        
        return $req;
    }
    
    public function countCommReport()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) FROM commentaire WHERE signale = 1');
        $nbCommentaireReported = $req->fetchColumn();

        return $nbCommentaireReported;
    }

    public function annuleSignale($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE commentaire SET signale=0 WHERE id=:id');
        $annuleSignale = $req->execute(array('id'=>$id));

        return $annuleSignale;
    }
}

?>