<?php include 'view/header.php';
// Redirige member vers home.php si role pas admin
if($_SESSION['role'] !=1){
  header('Location: index.php');
}
?>
    <div class="text-justify mb-5 col-8 offset-2 text-md-left col-md-4 offset-md-0">
        <div>
            <a href="index.php?action=dashboard" class="btn btn-primary">Retour à l'espace Administration</a><br/><br/>
                <?php
                if(empty($_SESSION) OR ($_SESSION['role'] != 1))
                {
                   $errorMessage = "INFO : Vous n'avez pas les droits necessaires pour faire de la moderation des articles.";
                }
                ?>
        </div>
    </div>
    <br/><br/><br/>
<h1>Moderation des commentaires</h1>
    <?php
        if(empty($_SESSION) OR ($_SESSION['role'] != 1))
        {
            $errorMessage = "INFO : Vous n'avez pas les droits necessaires pour faire de la moderation des commentaires.";
        }
    ?>
<br/><br/>
<?php
    /*
        AFFICHAGE COMMENTS POUR MODERATION APRES VERIF SI SESSION vaut admin donc 1
        CONTROLLER ENVOI $actionComments via function actionComments() AVEC TOUS LES COMMENTS
        CHANGE COULEUR SELON STATUT DANS DB(refuse,approuve,en attente)
    */
    if($actionComments != false)
    {
        foreach($actionComments as $comment)
        {
            //var_dump($comment);
            // DECIDER LA COULEUR SELON QUEL STATUT A LE COMMENT DANS DB (ATTENTE APPROUVE REFUSE) SUR LA PAGE DASHBOARD ACTIONS SUR COMMENTS
            if($comment['validation'] == "en attente")
            { ?>
                <ul class="list-group">
                    <strong><?= $comment['name'] . '</strong> a écrit : '; ?>
                    <p><li class="list-group-item list-group-item-action list-group-item-secondary"><?= $comment['comment']; ?></li>
                        Posté le :
                        <?= $comment['date']; ?>
                    </p>
                </ul>
                <?php
            }?>
            <?php
            if($comment['validation'] == "approuve")
            { ?>
                <ul class="list-group">
                    <strong><?= $comment['name'] . '</strong> a écrit : '; ?>
                    <p><li class="list-group-item list-group-item-action list-group-item-success"><?= $comment['comment']; ?></li>
                        Posté le :
                        <?= $comment['date']; ?>
                    </p>
                </ul>
                <?php
            }?>
            <?php
            if($comment['validation'] == "refuse")
            { ?>
                <ul class="list-group">
                    <strong><?= $comment['name'] . '</strong> a écrit : '; ?>
                    <p><li class="list-group-item list-group-item-action list-group-item-warning"><?= $comment['comment']; ?></li>
                        Posté le :
                        <?= $comment['date']; ?>
                    </p>
                </ul>
                <?php
            }?>
        <!--LIEN/BTN POUR ACTIONS SUR COMMENTS SONT AFFICHÉ SI SESSION VAUT admin-->
            <?php if(isset($_SESSION) AND ($_SESSION['role'] == 1)) : ?>
                <p>
                <a class="btn btn-outline-danger btn-sm" href="index.php?action=deleteCommentDashboard&id=<?= $comment['id'] ?>">Supprimer ce commentaire</a>
                <a class="btn btn-outline-success btn-sm" href="index.php?action=validationCurrentComment&id=<?= $comment['id'] ?>">Valider ce commentaire</a>
                <a class="btn btn-outline-warning btn-sm" href="index.php?action=rejectCurrentComment&id=<?= $comment['id'] ?>">Refuser ce commentaire</a>
                </p>
            <?php endif;
        }
    }
 include 'view/footer.php'; ?>
