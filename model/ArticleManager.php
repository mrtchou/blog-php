<?php

class ArticleManager extends DataBase
{
    /// RECUPERATION TOUS LES ARTICLES \\\
    // function pour recuperer tous les articles et faire un array pour chaque article
    public function getArticles()
    {
      //connexion DataBase
      $dataBase = new DataBase();
      //requete
      $req = $dataBase->query('SELECT * FROM articles WHERE posted = 1');

      //dans $req trop info, non exploitable
      //on fait une boucle puisque il y a plusieurs resultat fourni par query et on passe tout par fetch_assoc qui
      //permet de rendre le resultat exploitable sous forme array associatif
      //donc en gros il y a un tableau pour chaque article
      $listArticles = [];
      while($currentArticle = $req->fetch(PDO::FETCH_ASSOC))
      {
          $objetArticle = new Article($currentArticle);
          $listArticles[] = $objetArticle;
      }
      /*je place return a l'exterieur du while, pour que while
      parcours tous les item, si je place a l'interieur while
      parcourera seulement un item
      */
      return $listArticles;
    }

    /// RECUPERATION UN ARTICLE \\\
    public function getArticle($articleId)
    {
      $dataBase = new DataBase();
      $req = $dataBase->prepare('SELECT * FROM articles WHERE id = ?');
      $req->execute(array($articleId));

      //tableau recupere depuis la base
      $articleDB = $req->fetch();

      //$article nouvel instance dela class Article, avec en parametre tous les donnees de la table articles en DataBase
      $article = new Article($articleDB);
      $article->getTitle();
      $article->getContent();
      $article->getId();
      $article->getAuthor();
      //$article contient tous les getters et setters de la class Article.php, ces getters et setters peuvent faire venir
      //les attributs et methodes de Article.php
      return $article;
    }

    /// CREATION NEW ARTICLE \\\
    /// function pour inserer un nouveau article CREATION ARTICLE
    public function newArticle($creatArticle)
    {
      $dataBase = new DataBase();
      $newArticle = $dataBase->prepare('INSERT INTO articles(title, date, author, content) VALUES(:title, NOW(), :author, :content)');
      $newArticle->bindValue(':title', $creatArticle->getTitle());
      $newArticle->bindValue(':author', $creatArticle->getAuthor());
      $newArticle->bindValue(':content', $creatArticle->getContent());
      $return = $newArticle->execute();
      return $return;
    }

    /// MODIFICATION UN ARTICLES \\\
    public function updateArticleArticleManager($updateArticle)
    {
      $dataBase = new DataBase();
      $update = $dataBase->prepare('UPDATE articles SET title = :title, author = :author, content = :content WHERE articles.id = :id');
      $update->bindValue(':title', $updateArticle->getTitle());
      $update->bindValue(':content', $updateArticle->getContent());
      $update->bindValue(':author', $updateArticle->getAuthor());
      $update->bindValue(':id', $updateArticle->getId());
      $update->execute();
      return $update;
    }

    /// DELETE UN ARTICLE
    /*
        DELETE ARTICLE APPELÉ DEPUIS Controller par deleteCurrentArticle()
        ID RECUPERE PAR $_GET
        REQEUTE SQL POUR DELETE
    */
    public function deleteArticle($articleDeleted)
    {
      $dataBase = new DataBase();
      $delete = $dataBase->prepare('DELETE FROM articles WHERE articles . id = ?');
      $delete->execute(array($articleDeleted));
    }

    /// POUR VALIDER APPROUVE D'UN COMMENT DANS DataBase \\\\
    /*  FUNCTION APPELÉ DEPUIS ROUTER VIA CONTROLLER SELON $_GET[]=ACTION=rejectCurrentComment */
    public function validationArticle($articleId)
    {
      $dataBase = new DataBase();
      $articleValidatedDB = $dataBase->prepare('UPDATE `articles` SET `posted` = 1 WHERE `articles`.`id` = :articleId');
      $articleValidatedDB->bindValue(':articleId', $articleId);
      $articleValidatedDB->execute();
    }

    //// POUR VALIDER LE REFUSE D'UN COMMENT DANS DB \\\\
    /* FUNCTION APPELÉ DEPUIS ROUTER VIA CONTROLLER SELON $_GET[]=ACTION=rejectCurrentComment */
    public function refuseArticle($articleId)
    {
      $dataBase = new DataBase();
      $articleRefusedDB = $dataBase->prepare('UPDATE `articles` SET `posted` = 0 WHERE `articles`.`id` = :articleId');
      $articleRefusedDB->bindValue(':articleId', $articleId);
      $articleRefusedDB->execute();
    }

    ///FUNCTION POUR AFFICHER COMMENTS DANS actionComments.php via controller actionComments()
    public function getArticlesForAction()
    {
      $dataBase = new DataBase();
      /*
      $id est rempli par $_GET, puis $id est utilisé par bindValue
      pour inserer la valeur dans sql
      */
      $articles = $dataBase->prepare("SELECT * FROM articles ORDER BY date DESC");
      $articles->execute();

      $results = [];
      while ($currentArticle = $articles->fetch())
      {
          $objetArticle = new Article($currentArticle);
          $results[] = $currentArticle;
      }
      return $results;
      $articles->closeCursor();
    }
}
