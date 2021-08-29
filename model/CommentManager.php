<?php

class CommentManager extends DataBase
{
    /*
    recupere tous les commets, en specifiant id recu par $_GET,
    puis while, avec instanciation class Comment.
    */
    public function getComments($articleId)
    {
      $dataBase = new DataBase();
        /*
        $id est rempli par $_GET, puis $id est utilisé par bindValue
        pour inserer la valeur dans sql
        */
        $comments = $dataBase->prepare("SELECT * FROM comments WHERE validation = 'approuve' AND post_id = :post_id ORDER BY date DESC");
        $comments->bindValue(':post_id', $articleId);
        $comments->execute();

        $results = [];
        while ($currentComment = $comments->fetch())
        {
          $objetComment = new Comment($currentComment);
          $results[] = $currentComment;
        }
        return $results;
        $comments->closeCursor();
    }

    ///FUNCTION POUR AFFICHER COMMENTS DANS actionComments.php via controller actionComments()
    public function getCommentsForAction()
    {
      $dataBase = new DataBase();
        /*
        $id est rempli par $_GET, puis $id est utilisé par bindValue
        pour inserer la valeur dans sql
        */
        $comments = $dataBase->prepare("SELECT * FROM comments ORDER BY date DESC");
        $comments->execute();

        $results = [];
        while ($currentComment = $comments->fetch())
        {
          $objetComment = new Comment($currentComment);
          $results[] = $currentComment;
        }
        return $results;
        $comments->closeCursor();
    }

    //Function pour recuperer un comment precis, selon id
    public function getComment($commentId)
    {
      $dataBase = new DataBase();
        $req = $dataBase->prepare('SELECT * FROM comments WHERE id = ?');
        $req->execute(array($commentId));

        //tableau recupere depuis la base
        $commentDataBase = $req->fetch();

        //$article nouvel instance dela class Article, avec en parametre tous les donnees de la table articles en DataBase
        $comment = new Comment($commentDB);
        //$article contient tous les getters et setters de la class Article.php, ces getters et setters peuvent faire venir
        //les attributs et methodes de Article.php
        return $comment;
    }

    //pour inserer un comment nouveau
    public function addComment($comment)
    {
      $dataBase = new DataBase();
       $neWcomments = $dataBase->prepare('INSERT INTO comments(name, comment, post_id, date) VALUES(:name, :comment, :post_id, NOW())');
       $neWcomments->bindValue(':name', $comment->getName());
       $neWcomments->bindValue(':comment', $comment->getComment());
       $neWcomments->bindValue(':post_id', $comment->getPost_id());
       $neWcomments->execute();
       return $neWcomments;
    }

    // pour delete comment
    public function deleteComment($commentId)
    {
      $dataBase = new DataBase();
        $req = $dataBase->prepare('DELETE FROM comments WHERE comments.id = ?');
        $commentDelete = $req->execute(array($commentId));
    }

    /// POUR VALIDER APPROUVE D'UN COMMENT DANS DataBase \\\\
    /*  FUNCTION APPELÉ DEPUIS ROUTER VIA CONTROLLER SELON $_GET[]=ACTION=rejectCurrentComment */
    public function validationComment($commentId)
    {
      $dataBase = new DataBase();
       $commentValidatedDB = $dataBase->prepare('UPDATE `comments` SET `validation` = "approuve" WHERE `comments`.`id` = :commentId');
       $commentValidatedDB->bindValue(':commentId', $commentId);
       $commentValidatedDB->execute();
    }

    //// POUR VALIDER LE REFUSE D'UN COMMENT DANS DB \\\\
    /* FUNCTION APPELÉ DEPUIS ROUTER VIA CONTROLLER SELON $_GET[]=ACTION=rejectCurrentComment */
    public function refuseComment($commentId)
    {
      $dataBase = new DataBase();
       $commentValidatedDB = $dataBase->prepare('UPDATE `comments` SET `validation` = "refuse" WHERE `comments`.`id` = :commentId');
       $commentValidatedDB->bindValue(':commentId', $commentId);
       $commentValidatedDB->execute();
    }
}
