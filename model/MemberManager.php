<?php

class MemberManager extends DataBase
{
    // function pour recuperer tous les utilisateurs et faire un array pour chaque user
    public function getMembers()
    {
      $dataBase = new DataBase();
        //requete
        $req = $dataBase->query('SELECT * FROM user ');
        //dans $req trop info, non exploitable
        //on fait une boucle puisque il y a plusieurs resultat fourni par query et on passe tout par fetch_assoc qui
        //permet de rendre le resultat exploitable sous forme array associatif
        //donc en gros il y a un tableau pour chaque employe
        //$employe est donc un tableau ARRAY associatif (associatif = avec des clés nominatives).
        $listMembers = [];
        while($currentMembers = $req->fetch(PDO::FETCH_ASSOC))
        {
            $objetMember = new Member($currentMembers);
            $listMembers[] = $objetMember;
        }
        /*je place return a l'exterieur du while, pour que while
        parcours tous les item, si je place a l'interieur while
        parcourera seulement un item
        */
        return $listMembers;
    }

    //PAS ENCORE CREER ne functionne pas
    /// FUNCTION RECUPERE UN MEMEBER SELON LE member_name PASSE EN PARAM depuis controller //tableau recupere depuis la db
    public function getMember($nameRegister)
    {
      $dataBase = new DataBase();
        $req = $dataBase->prepare('SELECT * FROM user WHERE member_name = ?');
        $req->execute(array($nameRegister));
        $memberDB = $req->fetch();

        //$article nouvel instance dela class Article, avec en parametre tous les donnees de la table articles en DB
        $member = new Member($memberDB);
        //$article contient tous les getters et setters de la class Article.php, ces getters et setters peuvent faire venir
        //les attributs et methodes de Article.php
        return $member;
    }

    //pour inserer un nouveau membre/utilisateur le role est a attribuer d'une autre maniere(a reflechir..)
    public function addMember($newMember)
    {
      $dataBase = new DataBase();
        $req = $dataBase->prepare('INSERT INTO user(member_name, password) VALUES(:username, :password)');
        $req->bindValue(':username', $newMember->getMember_name());
        $req->bindValue(':password', $newMember->getPassword());
        $req->execute();
        return $req;
    }

    ///RECUPERE member_name DANS DB SELON PARAM RECU depuis controller authentication() qui est appelé par form login.php
    public function memberExistPass($member_name)
    {
      $dataBase = new DataBase();
        $req=$dataBase->prepare("SELECT password, member_name, role FROM user WHERE member_name = :username");
        //$req->bindValue(':username', $member_name);
        $req->execute(array(':username' => $member_name));
        $resultat = $req->fetch();
        return $resultat;
    }
}
