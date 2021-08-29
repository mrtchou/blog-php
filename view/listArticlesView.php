<?php require_once 'model/ArticleManager.php';
// toute la page sert a afficher tous les articles, cette page ensuite est recupere
// pour etre afficher dans template.php
//debut temporisation $content
ob_start(); ?>

<!--LIEN pour AJOUTER un nouveau ARTICLE-->
<?php
    if(!empty($_SESSION) AND $_SESSION['role'] == 1)
    {
    ?>
        <div class="btn-group btn-group-lg" role="group">
        <a class="dropdown-item" href="index.php?action=creationArticle">Creer un nouveau article</a>
        </div>
        <br/><br/><hr/>
    <?php
    }
?>
<h4 class="text-center">Derniers articles</h4>
<?php
    //variable tousLesArticles est transmise/envoyé depuis controller
    foreach ($tousLesArticles as $currentArticle)
    {
        echo  '<div class="row no-gutters bg-light position-relative">
                <a class="dropdown-item stretched-link" href="index.php?action=article&id=' .
                $currentArticle->getId() . ' "><h5><strong>' .
                $currentArticle->getTitle() . '</strong></h5></a><br/>' .
                $currentArticle->getContent() . '</div><br/> Auteur : ' .
                $currentArticle->getAuthor() . '<br/> publié le ' .
                $currentArticle->getDate() . '<br/><br/>';
        // BUTTON deroule pour ACTION SUR L'ARTICLE selon si $_SESSION \\
        if(!isset($_SESSION))
        {
        ?>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action sur l'article</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <button class="dropdown-item" type="button">
                        <?php echo '<a class="dropdown-item" href="index.php?action=article&id=' . $currentArticle->getId() . ' ">Modifier l\'Article</a>' ?>
                    </button>
                    <button class="dropdown-item" type="button">
                        <?php echo '<a class="dropdown-item" href="index.php?action=article&id=' . $currentArticle->getId() . ' ">Supprimer l\'Article</a>' ?>
                    </button>
                </div>
            </div>
        <hr/><br/><br/><br/>
        <?php
        }
        ?>
        <hr/><br/><br/><br/>
    <?php
    }
    // tout est mis dans la variable $content
    $content = ob_get_clean();

    // par la suite on deroule la page template.php qui a deja les formes
    // et dedans on va afficher tout ce qui est recupere plus haut
    require 'view/template.php'; ?>
