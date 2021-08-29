<?php session_start();
// on fait venir controller.php
// qui va faire connexion et requete avec differents functions
require_once 'controller/controller.php';
/*
On teste le paramètre 'action' pour savoir quel contrôleur
appeler (listArticles ou article)
Si le paramètre n'est pas présent, par défaut on charge la liste
des derniers articles. C'est comme ça qu'on indique
ce que doit afficher la page d'accueil du site.
On teste les différentes valeurs possibles pour
notre paramètre action et on redirige vers le bon contrôleur
 à chaque fois.
*/
try{
    if (isset($_GET['action'])) {

      ////////////////////  PARTIE ARTICLE  \\\\\\\\\\\\\\\\\\\\\\\\\\\\
      ////////////////////  PARTIE ARTICLE  \\\\\\\\\\\\\\\\\\\\\\\\\\\\
        if ($_GET['action'] == 'listArticles') {
            listArticles();
        }
        elseif ($_GET['action'] == 'article') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                article();
            }
            else
            {
                echo 'Erreur : aucun id article envoyé';
                throw new Exception('Aucun id article envoyé');
            }
        }

        elseif ($_GET['action'] == 'creationArticle') {
            //creationArticle();
            creationArticle();
        }

        // UPDATE ARTICLE
        elseif ($_GET['action'] == 'update'){
            updateArticle();
        }

        // DELETE ARTICLE
        // FUNCTION DELETE FONCTIONNE, SUPPRIME ARTICLE, PUIS AFFICHE LA PAGE AVEC TOUS LES ARTICLES
        elseif ($_GET['action'] == 'delete') {
            deleteCurrentArticle();
            listArticles();
        }

        ////////////////////  PARTIE COMMENT  \\\\\\\\\\\\\\\\\\\\\\\\\\\\
        ////////////////////  PARTIE COMMENT  \\\\\\\\\\\\\\\\\\\\\\\\\\\\
        elseif ($_GET['action'] == 'addComment') {
            addNewComment();
        }
        elseif ($_GET['action'] == 'homePage1') {
            homePage1();
        }
        elseif ($_GET['action'] == 'homePage2') {
            homePage2();
        }
        elseif ($_GET['action'] == 'curruculumVitae') {
            curruculumVitae();
        }

        
        elseif ($_GET['action'] == 'deleteCurrentComment') {
            deleteCurrentComment();
        }

        // DECISION COMMENT au niveau DASHBOARD (delete,approuve,refuse...)
        elseif ($_GET['action'] == 'deleteCommentDashboard'
                OR $_GET['action'] == 'validationCurrentComment'
                OR $_GET['action'] == 'rejectCurrentComment'
                OR $_GET['action'] == 'actionComments')
        {
            actionCommentAdmin();
        }

        // DECISION COMMENT au niveau DASHBOARD (delete,approuve,refuse...)
        elseif ($_GET['action'] == 'deleteArticleDashboard'
                OR $_GET['action'] == 'validationCurrentArticle'
                OR $_GET['action'] == 'rejectCurrentArticle'
                OR $_GET['action'] == 'actionsArticles')
        {
            actionArticlesAdmin();
        }

        ////////////////////  PARTIE MEMBER  \\\\\\\\\\\\\\\\\\\\\\\\\\\\
        ////////////////////  PARTIE MEMBER  \\\\\\\\\\\\\\\\\\\\\\\\\\\\
        // router voit register dans le lien dans footer et appel la function register() qui
        // dans controller et qui charge la page register.php
        elseif ($_GET['action'] == 'register') {
            newMemberRegister();
        }

        //login est actioné dans le formulaire de connexion login.php puis dans controller.php
        elseif ($_GET['action'] == 'login') {
            authentication();
        }

        // juste un lien dans le footer ou ailleur pour se connecter avec verif si SESSION empty ou pas
        elseif ($_GET['action'] == 'connexion' OR $_GET['action'] == 'dashboard') {
            is_member();
        }

        // juste un lien dans le footer ou ailleur pour se connecter avec verif si SESSION empty ou pas
        elseif (!empty($_GET['action'] == 'deconnexion') OR isset($_POST['deconnexion'])) {
            deconnexion();
            homePage();
        }
        // function pour envoyer email si form contact utilisé
        elseif (!empty($_GET['action']) == 'contact' OR isset($_POST['submitEmail'])) {
            contact();
            email();
        }
    }
    else
    {
        homePage();
    }
}
// si error, elle sera recupere ici par getMessage puis afficher sur page
// errorView.php
catch(Exception $e) {
    $errorMessage = $e->getMessage();
    require('view/errorView.php');
}
