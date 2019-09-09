<?php

namespace P4\model;

require_once("model/Manager.php");

class UserManager extends Manager
{
    public function inscription($pseudo,$mdp_hash)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO utilisateur(pseudo, mdp, isAdmin)VALUES(:pseudo, :mdp, 0)');
        $ajoutUtilisateur = $req->execute(array('pseudo'=>$pseudo,'mdp'=>$mdp_hash));

        return $ajoutUtilisateur;
    }

    public function testPseudo($pseudo)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT(*)FROM episode WHERE pseudo=:pseudo');
        $pseudo = $req->execute(array('pseudo'=>$pseudo));
        $pseudoUnique = mysqli_num_rows($pseudo);

        return $pseudoUnique;
    }

    public function connexionUtilisateur($pseudo, $mdp)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT pseudo, mdp, isAdmin FROM utilisateur WHERE pseudo = :pseudo');
        $req->execute(array('pseudo'=>$pseudo));
        $resultat = $req->fetch();

        return $resultat;
    }
}

?>