<?php include_once 'view/header.php';
// LIENS DANS PAGE POUR (retour dashboard, creer article, aller a la list articles) SELON SI SESSION ADMIN
if(!empty($_SESSION) AND ($_SESSION['role'] == 1))
{
?>
  <div class="text-justify mb-5 col-8 offset-2 text-md-left col-md-4 offset-md-0">
      <div>
          <a href="index.php?action=dashboard" class="btn btn-primary">Retour à l'espace Administration</a><br/><br/>
          <a class="btn btn-primary" href="index.php?action=creationArticle">Creer un nouveau article</a><br/><br/>
          <a class="btn btn-primary" href="index.php?action=listArticles">liste des articles</a><br/>
    </div>
  </div>
<?php
}
if (empty($_SESSION) OR $_SESSION['role'] != 1) {
?>
  <p>
    <a href="index.php?action=listArticles">Retour à la liste des articles</a>
  </p>
<?php
}
?>
<!-- FORMULAIRE CREATION NEW ARTICLE
    POUR ACCEDER A CET PAGE FAUT ETRE CONNECTER
    FORM EST TRAITER DANS Controller par creationArticle()
     DONC CREE ARTICLE, PUIS DIRECT SUR PAGE DE TOUS ARTICLES-->
<h4 class="p-2 text-center text-muted">Formulaire de creation d'article</h4>
  <form id="form-contact" action="" method="POST">
    <div class="shadow-sm w-75 p-3 mb-5 bg-white rounded"><label>Titre de l'article</label>
        <input type="text" class="form-control" name="title_article" placeholder="choisissez un titre pour votre article" required>
    </div>
    <div class="shadow-sm h-50 w-75 d-inline-block p-3 mb-5 bg-white rounded"><label>Redaction de l'article : </label>
        <textarea type="text" class="form-control" rows="7" name="redaction_article" placeholder="Vous pouvez rediger votre article ici" required></textarea>
    </div>
    <div class="form-row shadow-sm col w-75 p-3 mb-5 bg-white rounded">
        <label class="mr-2" for="userLastname">Nom</label>
        <input type="text" class="form-control col" name="userLastname" placeholder="votre nom d'auteur" required>
    </div>
    <div class="col-lg-12 text-center">
        <button type="submit" class="btn btn-primary"  name="submit">Envoyer</button>
    </div>
  </form>

<?php include_once 'view/footer.php'; ?>
