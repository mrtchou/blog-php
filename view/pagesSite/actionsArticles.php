<?php include 'view/header.php';

// Redirige member vers home.php si role pas admin
if($_SESSION['role'] !=1)
{
    header('Location: index.php');
}
?>
    <div class="text-justify mb-5 col-8 offset-2 text-md-left col-md-4 offset-md-0">
        <div>
            <a href="index.php?action=dashboard" class="btn btn-primary">Retour à l'espace Administration</a><br/><br/>
                <?php
                if(empty($_SESSION) OR ($_SESSION['role'] != 1))
                {
                    echo "INFO : Vous n'avez pas les droits necessaires pour faire de la moderation des articles.";
                }
                if ($_SESSION['member_name'])
                {
                    // LIEN pour AJOUTER un nouveau ARTICLE  visible si admin\\\
                ?>
            <a class="btn btn-primary" href="index.php?action=creationArticle">Creer un nouveau article</a>
        </div>
    </div><br/><br/>
            <?php } ?>
<h1 class="text-center">Moderation des articles</h1><br/><br/>
<?php
/*
    AFFICHAGE ARTICLES POUR MODERATION APRES VERIF SI SESSION vaut admin
    CONTROLLER ENVOI $actionArticles via function actionArticles() AVEC TOUS LES ARTICLES
    CHANGE COULEUR SELON STATUT DANS DB(1 posted donc vert, 0 posted donc gris)
*/
if($actionArticles != false)
{
    foreach($actionArticles as $article)
    {
        // DECIDER LA COULEUR SELON QUEL STATUT A l'article DANS DB (0, 1) SUR LA PAGE DASHBOARD ACTIONS SUR ARTICLES
        if($article['posted'] == 1)
        { ?>
            <ul class="list-group">
                <strong><?= $article['author'] . '</strong> a écrit : '; ?>
                <p><li class="list-group-item list-group-item-action list-group-item-success"><?= $article['content']; ?></li>
                    Posté le :
                    <?= $article['date']; ?>
                </p>
            </ul>
    <?php }
        if($article['posted'] == 0)
        { ?>
            <ul class="list-group">
                <strong><?= $article['author'] . '</strong> a écrit : '; ?>
                <p><li class="list-group-item list-group-item-action list-group-item-secondary"><?= $article['content']; ?></li>
                    Posté le :
                    <?= $article['date']; ?>
                </p>
            </ul>
    <?php }
    //LIEN/BTN POUR ACTIONS SUR ARTICLES SONT AFFICHÉ SI SESSION VAUT admin donc 1 en DB-->
    if($_SESSION['role'] == 1): ?>
        <p>
        <a class="btn btn-outline-danger btn-sm" href="index.php?action=deleteArticleDashboard&id=<?= $article['id'] ?> ">Supprimer cet article</a>
        <a class="btn btn-outline-success btn-sm" href="index.php?action=validationCurrentArticle&id=<?= $article['id'] ?> ">Valider article</a>
        <a class="btn btn-outline-warning btn-sm" href="index.php?action=rejectCurrentArticle&id=<?= $article['id'] ?> "> Refuser cet article</a>
        <a class="btn btn-outline-secondary btn-sm" href="index.php?action=update&id=<?= $article['id'] ?>">Modifier cet article</a>
        </p>
    <?php endif;
    }
}
include 'view/footer.php'; ?>
