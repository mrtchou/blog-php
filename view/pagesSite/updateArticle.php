<?php include_once 'view/header.php'; ?>
    <?php
    // Redirige member vers home.php si session vide(pas connecté)
    if($_SESSION['role'] == 0)
    {
        header('Location: index.php');
    }
    // LIENS DANS PAGE updateArticle.php POUR (retour dashboard, creer article, aller a la list articles) SELON SI SESSION ADMIN
    if(!empty($_SESSION) AND ($_SESSION['role'] == 1))
    {
        ?>
        <div class="text-justify mb-5 col-8 offset-2 text-md-left col-md-4 offset-md-0">
            <div>
                <a href="index.php?action=dashboard" class="btn btn-primary">Retour à l'espace Administration</a><br/><br/>
                <a class="btn btn-primary" href="index.php?action=creationArticle">Creer un nouveau article</a><br/><br/>
                <a class="btn btn-primary" href="index.php?action=listArticles">La liste des articles</a><br/>
            </div>
        </div>
        <?php
    }
    if (empty($_SESSION))
    {?>
        <p>
            <a href="index.php?action=listArticles">Retour à la liste des articles</a>
        </p>
    <?php
        } ?>
    <h4 class="text-center" >EDITION DE L'ARTICLE</h4>
    <!--FORMULAIRE PREREMPLI POUR UPDATE UN article
        PAGE EST AFFICHÉ SUITE AU CLICK sur UPDATE SOUS L'ARTICLE, DANS articleView.php OU DANS DASHBOARD
        ENSUITE ROUTER FAIT APPEL AU Controller QUI CHAGRE LA PAGE updateArticle.php si update DANS $_GET
        ET TRANSMET LA VARIABLE $articleUpdateController a la PAGE updateArticle.php
        AVEC LES METHOD DE ArticleManager()-->
    <form id="form-contact" action="" method="POST">
            <div class="shadow-sm col-7 md-4 ml-auto mr-auto bg-white rounded">
                <label>Editer du titre de l'article</label>
                <input type="text" class="form-control" name="updateTitle_article" value="<?php echo $articleUpdateContr->getTitle(); ?>" required>
            </div><br/>
            <div class="shadow-sm col-auto md-9 ml-auto mr-auto bg-white rounded">
                <label>Editer de l'article</label>
                <textarea type="text" class="form-control md-textarea" rows="11" name="updateContent" required><?php echo $articleUpdateContr->getContent(); ?></textarea>
            </div><br/>
            <div  class="shadow-sm col-7 md-4 ml-auto mr-auto bg-white rounded">
                <label>Editer du Nom d'auteur</label>
                <input type="text" class="form-control col" name="updateUserLastname" value="<?php echo $articleUpdateContr->getAuthor(); ?>" required>
            </div><br/>
            <div class="col-lg-12 text-center">
                <button type="submit" class="btn btn-primary"  name="ValiderModificationArticle">Envoyer</button>
            </div>
    </form><br/><br/><br/>
<?php include_once 'view/footer.php'; ?>
