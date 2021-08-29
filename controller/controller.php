<?php
//chargement des class FAIT VENIR LE FICHIER, PUIS APPEL A LA CONSTANTE Autoloader
require 'Autoloader.php';
Autoloader::register();


/* PARTIE ARTICLES *//* PARTIE ARTICLES *//* PARTIE ARTICLES *//* PARTIE ARTICLES */
/* PARTIE ARTICLES *//* PARTIE ARTICLES *//* PARTIE ARTICLES *//* PARTIE ARTICLES */
    ///RECUPERE TOUS LES ARTICLES\\\
    // appel une class puis cree objet
    // Appel d'une fonction de cet objet
    // on envoi tout vers view ou on voit tous les cars
    function listArticles()
    {
        $articleManager = new ArticleManager(); //instanciation de la class CarManager
        $tousLesArticles = $articleManager->getArticles(); //cet objet demande la function getCars
        // on envoi tout vers view
        require 'view/listArticlesView.php';
    }

    ///RECUPERE UN ARTICLE\\\
    /* appel une class puis cree objet
    cet objet appel une function pour recuperer 1 article avec ses comments
    puis envoi tout sur page articleView sur laquel on voit et article et ses comments
    */
    function article()
    {
      $articleId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

      $articleManager = new ArticleManager();
      $commentManager = new CommentManager();

      $article = $articleManager->getArticle($articleId);
      $comments = $commentManager->getComments($articleId);
      require 'view/articleView.php';
    }

    /*
    FUNCTION APPELÉ VIA ROUTER, PUIS CHARGE LA PAGE DE CREATION ARTICLE si $_POST n'xiste
    ENSUITE au button valider on repasse ici et SI $_POST DETECTE SUBMIT, CHARGE LES INFOS DU FORMULAIRE article_creation.php
    CREE NEW OBJET Article ET ArticleManager ET LEURS TRANSMET LES INFOS VIA LEURS METHOD
    param pour petite securite POST recoit les trois param alors creation instance de Article() et instance de ArticleManager()
    */
    function creationArticle()
    {
      /// verif si $_POST, puis recuperation valeur par $_POST, et securisation
      $submitPost = filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_SPECIAL_CHARS);
      if(isset($submitPost))
      {
        $errorMessage = '';
        $titleNewArticle = htmlspecialchars(trim($_POST['title_article']));
        $redactionNewArticle = htmlspecialchars(trim($_POST['redaction_article']));
        $authorNewArticle = htmlspecialchars(trim($_POST['userLastname']));

        //ensuite verif si tous champs remplis et appel a la function (HTML REQUIRED FAIT AUSSI)
        if(!empty($titleNewArticle) && !empty($redactionNewArticle) && !empty($authorNewArticle))
        {
          $creatArticle = new Article();
          $creatArticle->setTitle($titleNewArticle);
          $creatArticle->setAuthor($authorNewArticle);
          $creatArticle->setContent($redactionNewArticle);

          // ici je new objet et fait appel aux methode de la class ArticleManager Puis envoi tout vers listArticlesView.php
          $articleManager = new ArticleManager();
          $isReqOk = $articleManager->newArticle($creatArticle);
          $tousLesArticles = $articleManager->getArticles();
          require('view/listArticlesView.php');
        }
        if(empty($titleNewArticle) OR empty($redactionNewArticle) OR empty($authorNewArticle))
        {
          $errorMessage = 'Tous les champs ne sont pas rempli';
        }
        if (!empty($errorMessage))
        {
          require 'view/errorView.php' ;
        }
      }
      else
      {
        require 'view/pagesSite/article_creation.php' ;
      }
    }

    //Function pour modifier un article
    /*
    APPELÉ DEPUIS ROUTER SI $_GET=UPDATE
    SI $_POST EMPTY ALORS NEW OBJET, PUIS APPEL DE SA METHOD POUR FAIRE AFFICHER L'ARTICLE SELECTIONÉ
    AVEC SON ID RECUPERÉ PAR $_GET ET SI POST VIDE, CHARGE LA PAGE updateArticle.php
    SI POST EXIST ALORS RECUP DATA DEPUIS FORM sur page updateArticle.php
    NEW OBJET Article APPEL REMPLI SETTER
    PUIS NEW ManagerArticle AVEC SES METHODE UPDATE REQUETE SQL, PUIS AFFICHE ARTICLE
    */
    function updateArticle()
    {
      if(!empty($_SESSION))
      {$submitPost = filter_input(INPUT_POST, 'ValiderModificationArticle', FILTER_SANITIZE_SPECIAL_CHARS);

        if(empty($submitPost))
        {
          $articleManager = new ArticleManager();
          $articleId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
          $articleUpdateContr = $articleManager->getArticle($articleId);
          if(empty($_POST)){
            require 'view/pagesSite/updateArticle.php' ;
          }
        }
        if(isset($submitPost))
        {
          //require('view/pagesSite/updateArticle.php');
          $updateTitle_article = htmlspecialchars(trim($_POST['updateTitle_article']));
          $updateContent = htmlspecialchars(trim($_POST['updateContent']));
          $updateUserLastname = htmlspecialchars(trim($_POST['updateUserLastname']));
          $edit_id = htmlspecialchars($articleId);

          // instanciation puis passages de valeurs a l'objet par ses setter
          $updateArticle = new Article();
          $updateArticle->setTitle($updateTitle_article);
          $updateArticle->setContent($updateContent);
          $updateArticle->setAuthor($updateUserLastname);
          $updateArticle->setId($edit_id);

          // instanciation puis passages de valeurs a l'objet par ses methode
          $articleManagerUpdate = new ArticleManager();
          $articleUpdated = $articleManagerUpdate->updateArticleArticleManager($updateArticle);
          $articleUpdateContr = $articleManagerUpdate->getArticle($articleId);
          require 'view/pagesSite/updateArticle.php' ;
        }
      }
    }


    /*
    DELETE ARTICLE FUNCTION APPELÉ DEPUIS LIEN SOUS L'ARTICLE VIA ROUTER
    FONCTION POSSIBLE SEULEMENT SI ADMIN
    QUI RECUPERE ID DE L'ARTICLE AVEC METHOD getId() QUI EST APPELÉ PAR
    $article qui est fabriqué est transmise depuis la function article() dans controller
    */
    function deleteCurrentArticle()
    {
      $articleId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
      $sessionAdmin = htmlspecialchars(trim($_SESSION['role'] == 1));
      if(isset($sessionAdmin))
      {
        $articleManager = new ArticleManager();
        $articleDeleted = $articleManager->deleteArticle($articleId );
        $tousLesArticles = $articleManager->getArticles();
      }
    }

    // POUR RECUPERER articles DANS DB ET TRANSMETTRE VERS actionsArticles.php QUI SERA VISIBLE DEPUIS DASHBOARD
    function actionArticles()
    {
      $articlesManagerr = new ArticleManager();
      $actionArticles = $articlesManagerr->getArticlesForAction();
      require_once 'view/pagesSite/actionsArticles.php';
    }

    /*
    VALIDATION COMMENT DANS DB  (REFUSE ou APPROUVE)
    APPEL DE LA FUNCTION DEPUIS ROUTER
    VALIDE OU REFUSE SELON SI $_GET ACTION VAUT "validationCurrentComment" OU "rejectCurrentComment"
    APPEL DE LA METHOD DE CommentManager validationComment() AVEC PARAM ID DU COMMENT \\\
    */
    function actionArticlesAdmin()
    {
      $articleId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
      $articleAction = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
      if(isset($articleAction) AND isset($articleId))
      {
        
        $articleManager = new ArticleManager();

        if($articleAction == "validationCurrentArticle")
        {
        $articleValidated = $articleManager->validationArticle($articleId);
        }
        elseif($articleAction == "rejectCurrentArticle")
        {
        $articleRefused = $articleManager->refuseArticle($articleId);
        }
        elseif($articleAction == "deleteArticleDashboard")
        {
        $currentArticle = $articleManager->getArticle($articleId);

        $articleDeleted = $articleManager->deleteArticle($articleId);
        }
        $actionArticles = $articleManager->getArticlesForAction();
        require_once 'view/pagesSite/actionsArticles.php';
      }
      else {
        $articleManager = new ArticleManager();
        $actionArticles = $articleManager->getArticlesForAction();
        require_once 'view/pagesSite/actionsArticles.php';
      }
    }

/* PARTIE COMMENTS *//*  PARTIE COMMENTS   *//*  PARTIE COMMENTS *//* PARTIE COMMENTS */
/* PARTIE COMMENTS *//*  PARTIE COMMENTS   *//*  PARTIE COMMENTS *//* PARTIE COMMENTS */
    ///AJOUTE COMMENTAIRE\\\
    // appel class puis instancie
    // redirige vers page ou on a commente avec $articleId
    function addNewComment()
    {
      $submitPost = filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_SPECIAL_CHARS);
      $articleId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
      if(isset($submitPost))
      {
      $name = htmlspecialchars(trim($_POST['name']));
      $commentTxt = htmlspecialchars(trim($_POST['comment']));
      $articleId = htmlspecialchars(trim($articleId));
      }
      $comment = new Comment();
      $comment->setPost_id($articleId);
      $comment->setName($name);
      $comment->setComment($commentTxt);

      $commentManager = new CommentManager();
      $commentsCreated = $commentManager->addComment($comment);
      header('Location:index.php?action=article&id=' . $articleId);
    }

    /*
    LIEN DELETE COMMENT SOUS SON ARTICLE AVEC ID RECUPERE PAR GET
    CREATION INSTANCE PUIS APPEL DE SES METHOD
    ENSUITE REDIRECTION VERS PAGE DE L'ARTICLE COURANT(RAFRAISHI PAGE)
    */
    function deleteCurrentComment()
    {
      $articleId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
      $commentManager = new CommentManager();
      $currentComment = $commentManager->getComment($articleId);
      $postId = $currentComment->getPost_id();
      $comments = $commentManager->deleteComment($articleId);
      header('Location:index.php?action=article&id=' . $postId);
    }

    /*
    VALIDATION COMMENT DANS DB  (REFUSE ou APPROUVE)
    APPEL DE LA FUNCTION DEPUIS ROUTER
    VALIDE OU REFUSE SELON SI $_GET ACTION VAUT "validationCurrentComment" OU "rejectCurrentComment"
    APPEL DE LA METHOD DE CommentManager validationComment() AVEC PARAM ID DU COMMENT \\\
    */
    function actionCommentAdmin()
    {
      $articleId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
      if(isset($articleId))
      {
        $action = $_GET['action'];
        $commentManager = new CommentManager();

        if($action == "validationCurrentComment")
        {
            $commentValidated = $commentManager->validationComment($articleId);
        }
        elseif($action == "rejectCurrentComment")
        {
            $commentValidated = $commentManager->refuseComment($articleId);
        }
        elseif($action == "deleteCommentDashboard")
        {
            $currentComment = $commentManager->getComment($articleId);
            //$commentId = $commentManager->getPost_id();
            $comments = $commentManager->deleteComment($articleId);
        }
        $actionComments = $commentManager->getCommentsForAction();
        require_once 'view/pagesSite/actionComments.php';
      }
      else
      {
        $commentManager = new CommentManager();
        $actionComments = $commentManager->getCommentsForAction();
        require_once 'view/pagesSite/actionComments.php';
      }
    }

    /*
    FUNCTION POUR GERER COMMENTAIRE une fois session active
    CREATION INSTANCE CommentManager PUIS APPEL DE SES METHOD
    ET REQUIRE DE LA PAGE OU SONT AFFICHE TOUS LES COMMENTS
    */
    function actionComments()
    {
      $commentManagerr = new CommentManager();
      $actionComments = $commentManagerr->getCommentsForAction();
      require_once 'view/pagesSite/actionComments.php';
    }

    /* PARTIE MEMBER *//* PARTIE MEMBER *//* PARTIE MEMBER *//* PARTIE MEMBER *//* PARTIE MEMBER */
    /* PARTIE MEMBER *//* PARTIE MEMBER *//* PARTIE MEMBER *//* PARTIE MEMBER *//* PARTIE MEMBER */
    /*
    ADD MEMBER ou CONNEXION MEMBER selon si $_POST exist
    VERIF LONGUEUR POST PUIS SECURITE PUIS SUPPRIME ESPACE
    VERIF SI POST > < A TROIS CARACTERES
    CREATION new Memeber AVEC PARAM RECU PAR POST et INSTANCE MemberManager
    APPEL METHOD addMemebr() avec en PARAM INSTANCE Memeber
    si $memberCreated vaut 1, donc redirection vers login.php
    */
    function newMemberRegister()
    {
      $submitPost = filter_input(INPUT_POST, 'newMemberRegister', FILTER_SANITIZE_SPECIAL_CHARS);
      /// verif si $_POST, puis recuperation valeur par $_POST, et securisation
      if(isset($submitPost))
      {
        //$nameRegister = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
        $nameRegister = strlen(htmlspecialchars(trim($_POST['user'])));
        //$passwordRegister = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        $passwordRegister = strlen(htmlspecialchars(trim($_POST['password'])));

        if ($nameRegister < 3 OR $passwordRegister < 3)
        {
          $errorMessage = 'un pseudo ou un mot de passe doit etre composé d\'au moins quatres lettres ou chiffres.<br/><a href="index.php?action=register">Recommencer</a>';
          if (!empty($errorMessage)) {
            require ('view/errorView.php');
          }
        }
        if ($nameRegister > 3 OR $passwordRegister > 3)
        {
          $nameRegister = htmlspecialchars(trim($_POST['user']));
          $passwordRegister = htmlspecialchars(trim($_POST['password']));
          $passwordRegister = password_hash($passwordRegister, PASSWORD_DEFAULT);

          $newMember = new Member();
          $newMember->setMember_name($nameRegister);
          $newMember->setPassword($passwordRegister);

          $memberManager = new MemberManager();
          $memberCreated = $memberManager->addMember($newMember);

          if ($memberCreated != 0)
          {
            require_once 'view/pagesSite/login.php';
          }
        }
      }
      else
      {
        require_once 'view/pagesSite/register.php';
      }
    }

















    /*
    CONNEXION ESPACE MEMBER
    APPELE PAR ROUTER
    SI SSESSION REDIRECTION VERS DASHBOARD
    SI NON VERIF INFO ENVOYE PAR POST ET INFO DB AVEC INSTANCE MemberManager ET SA METHODE memberExistPass()
    PUIS VERIF PASSWORD DB ET PASSWORD POST SI IDENTIQUE OU PAS
    SI TOUT OK REMPLISSAGE DE LA SESSION
    */
    function authentication()
    {
        if(isset($_SESSION['member_name']) AND $_SESSION['role'] == 1)
        {
          require 'view/pagesSite/dashboard.php';
        }
        if(isset($_SESSION['member_name']))
        {
          require 'view/pagesSite/homePage.php';
        }
        else
        {
            //si le formulaire est envoyé
            $validerPost = filter_input(INPUT_POST, 'valider', FILTER_SANITIZE_SPECIAL_CHARS);
            if(isset($validerPost))
            {
                //vérifie si tous les champs sont bien pris en compte:
                $postMemberName = filter_input(INPUT_POST, 'member_name', FILTER_SANITIZE_SPECIAL_CHARS);
                $postPassChek = filter_input(INPUT_POST, 'checkPassword', FILTER_SANITIZE_SPECIAL_CHARS);
                if(empty($postMemberName) OR empty($postPassChek))
                {
                    $errorMessage = 'Un des champs n\'est pas rempli pour se connecter. <a href="index.php?action=connexion">Retourner à la page de connexion.</a>';
                    if (!empty($errorMessage)) {
                    require 'view/errorView.php';
                    }
                }
                if(!empty($postMemberName) AND !empty($postPassChek))
                {
                    //on défini variables:
                    //$memberNameForm = htmlentities($_POST['member_name'],ENT_QUOTES,"UTF-8");//htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format
                    //$userPasswordForm = htmlspecialchars(trim($_POST['checkPassword']));

                    $memberManager = new MemberManager();
                    $isMemberCheked = $memberManager->memberExistPass($postMemberName);

                    //$memberCheckedd = $memberManager->memberExistPass($member_name);
                    //VERIF PASS DB HASH et PASS POST CLAIR sont IDENTIQUE
                    // Comparaison du pass envoyé via le formulaire avec la base
                    if (($isMemberCheked == false)) {
                    $errorMessage = 'Mauvais identifiant ou mot de passe ! <a href="index.php?action=connexion">Retourner à la page de connexion.</a>';
                        if (!empty($errorMessage)) {
                        require 'view/errorView.php';
                        }
                    }
                    else
                    {
                        $passwordCheked = password_verify($postPassChek, $isMemberCheked["password"]);

                        //var_dump($passHashDB);
                        if (($passwordCheked == false) OR ($isMemberCheked["member_name"] != $postMemberName))
                        {
                            $errorMessage = 'Mauvais identifiant ou mot de passe !<a href="index.php?action=connexion">Retourner à la page de connexion</a>';
                            if (!empty($errorMessage)) {
                            require ('view/errorView.php');
                            }
                        }
                        else
                        {   // SI member_name EXIST ET password OK ALORS REMPLI $_SESSION ET RAFRAISHI PAGE
                            if (isset($passwordCheked)) {
                            $_SESSION["member_name"] = $isMemberCheked["member_name"];
                            $_SESSION["role"] = $isMemberCheked["role"];
                            $_SESSION['messageSuccesConnexion'] = 'Vous êtes connecté !';
                            header('Location: inndex.php?action=login');
                            }
                            else {
                                $errorMessage = 'Mauvais identifiant ou mot de passe !<a href="index.php?action=connexion">Retourner à la page de connexion</a>';
                                if (!empty($errorMessage)) {
                                    require 'view/errorView.php';
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    // POUR SE CONNECTER A L'ESPACE PERSONNEL
    // FUNCTION VERIF SI SESSION VIDE OU PAS ET REDIRECTION VERS DASHBOARD OU LOGIN SELON SESSION
    function is_member()
    {
        if(empty($_SESSION))
        {
            require 'view/pagesSite/login.php';
        }
        else
        {
            require 'view/pagesSite/dashboard.php';
        }
    }

    // VIDE ET DETRUIT SESSION AU PASSGE DE deconnexion PAR GET OU PAR POST
    // DEUX LIENS PEUVENT FAIRE APPEL SOIT DANS HEADER, SOIT DANS FOOTER
    function deconnexion()
    {
      $submitPost = filter_input(INPUT_POST, 'deconnexion', FILTER_SANITIZE_SPECIAL_CHARS);
      $articleId = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
      if(($articleId == 'deconnexion') OR isset($submitPost))
        {
        session_unset();
        session_destroy();
        }
    }

    /* NE FONCTIOONNE PAS AU 9.5.21
    function POUR ENVOYER UN EMAIL VIA FORM CONTACT.php
    TOUS VARIABLES REMPLI PAR POST
    */
    function email()
    {
      $submitPost = filter_input(INPUT_POST, 'submitEmail', FILTER_SANITIZE_SPECIAL_CHARS);
        if (isset($submitPost))
        {
          $subject = filter_input(INPUT_POST, 'emailSubject', FILTER_SANITIZE_SPECIAL_CHARS);

            // corps du message email
            $toAdresse = "organyister@gmail.com";
            //$subject  = $_POST["emailSubject"];
            $emailContent = htmlspecialchars($_POST["firstnameEmail"]) . " " . htmlspecialchars($_POST["nameEmail"]) . " Contenu du message:<br>" . htmlspecialchars($_POST["emailContent"]);
            $headers  = 'From: organyister@gmail.com '. "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/html; charset=utf-8';

            if(mail($toAdresse, $subject, $emailContent, $headers))
            {
                $successMessage = 'Email bien envoyé';
                if (!empty($successMessage))
                {
                require 'view/errorView.php';
                }
            }
            else
            {
                $messageErrorEmail = "L'envoi du message a échoué.";
            }
        }
    }

/* PARTIE redirection... *//* PARTIE redirection... *//* PARTIE redirection... */
/* PARTIE redirection... *//* PARTIE redirection... *//* PARTIE redirection... */
    //HOME PAGE
    function homePage()
    {
      // on envoi tout vers view
      require 'view/pagesSite/homePage.php';
    }
    function contact()
    {
      // on envoi tout vers view
      require 'view/pagesSite/contact.php';
    }
    function curruculumVitae()
    {
      // on envoi tout vers view
      require 'view/pagesSite/cv.php';
    }
