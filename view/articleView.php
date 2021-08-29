<?php include 'header.php'; ?>
<p>
  <a href="index.php?action=listArticles">Retour à la liste des articles</a>
</p><br><br>
<h1>Mes articles tres utiles</h1>
<br><br><br><br>
    <div class="new-articles">
        <strong><h4><?= /*variable $article est transmise depuiscontrolleur */htmlspecialchars($article->getTitle()) ?></strong></h4>
        <?= /*variable $article est transmise depuiscontrolleur */ nl2br(htmlentities(htmlspecialchars($article->getContent())))?>
        <br/><hr/>
        <h6>le <?= /*variable $article est transmise depuiscontrolleur */htmlspecialchars($article->getDate()) ?></h6>
        <h6>Par <?= /*variable $article est transmise depuiscontrolleur */htmlspecialchars($article->getAuthor()) ?>. </h6>
        <!--SUPPRIMER/MODIFIER L'ARTICLE COURANT...sur articleView.php LIEN SOUS L'AUTEUR avec l'id du article qui est recuperer avec $article->getId()
            le LIEN APPEL UNE FUNCTION DANS CONTROLLER VIA ROUTER
            SI admin deux liens Si member juste lien pour modifier-->
        <?php
            $sessionAdmin = $_SESSION['role'] == 1;
            $submitPost = filter_input(INPUT_POST, 'ValiderModificationArticle', FILTER_SANITIZE_SPECIAL_CHARS);
            if(!empty($_SESSION))
            {
                if ($sessionAdmin == true)
                { ?>
                    <div class="btn">
                        <a href="index.php?action=delete&id=<?= $article->getId(); ?>">Supprimer cet article</a>
                    </div>
        <?php   }
                if ($_SESSION)
                {?>
                    <div class="btn">
                        <a href="index.php?action=update&id=<?= $article->getId(); ?>">Modifier cet article</a>
                    </div>
        <?php   }
            } ?>
    </div><br><hr /><br>
<!--/// ici formulaire html pour ecrire et envoyer un comment sur la page individuel de 1 article \\\-->
<?php if(!empty($_SESSION))
      { ?>
        <h2>Commentaires</h2>
        <form action="index.php?action=addComment&id=<?= $article->getId() ?>" method="POST">
            <div class="form-row shadow-sm col w-75 p-3 mb-5 bg-white rounded">
                <input type="text" class="form-control col" name="name" placeholder="votre nom d'auteur" required>
            </div>
            <div class="form-row shadow-sm col w-75 p-3 mb-5 bg-white rounded">
                <textarea type="text" class="form-control col" name="comment" placeholder="votre commentaire" required></textarea>
            </div>
            <div class="col-lg-12 w-75 text-center">
                <button type="submit" class="btn btn-primary"  name="submit">Envoyer</button>
            </div>
        </form>
<?php } ?><br><br><hr /><br><br>
<!--/// variable $comments envoyé/transmise depuis controller; puis si $comments
        contient qqchose donc pas false, alors affichage \\\-->
    <div class="zone_comment">
        <h4 class="text-center">Commentaires:</h4>
        <?php if($comments != false)
                {
                    foreach($comments as $comment)
                    {
                    ?>
                    <blockquote>
                        <strong><?= $comment['name'] . '</strong> a écrit : '; ?>
                        <p>
                            <?= $comment['comment'] . ' <br/>'; ?><br/>
                            le : <?= $comment['date']; ?>
                        </p>

                        <?php // SI member CONNECTÉ ADMIN ALORS POSSIBLE LIENS SUPPRIMER COMMENTS

                            if(!empty($_SESSION) AND $sessionAdmin)
                            {
                        ?>
                        <p>
                            <a href="index.php?action=deleteCurrentComment&id=<?= $comment['id'] ?>">Supprimer ce commentaire</a>
                        </p>
                        <?php
                            }
                        ?>
                    </blockquote>
                    <?php
                    }
                }
                $sessionMember = $_SESSION['member_name'];
                if(empty($sessionMember))
                {
                    echo 'Il faut etre enregistré sur le site pour pouvoir ajouter des commentaires.';
                }
                else
                {
                    echo "Aucun commentaire n'a été publié... Soyez le premier!";
                }
        ?><br><br><hr /><br><br>
    </div>
<?php require_once 'footer.php'; ?>
