<?php require_once 'view/header.php';
// Redirige member vers home.php si role pas admin
if($_SESSION['role'] !=1)
{
  header('Location: index.php');
} ?><br/><br/
<!-- LIENS SUR PAGE DASHBOARD, VISIBLE SEULEMENT SI ADMIN -->
<?php if ($_SESSION['member_name'] AND $_SESSION['role'] == 1)
        { ?>
        <h1 class="text-center">DASHBOARD</h1>
        <div class="list-group">
            <a href="index.php?action=listArticles" class="list-group-item list-group-item-action">Accéder aux articles en ligne</a>
            <a href="index.php?action=consigneProjetOpen" class="list-group-item list-group-item-action">Découvrir le projet 4 openclassrooms</a>
            <a href="index.php?action=actionComments" class="list-group-item list-group-item-action">Moderation des commentaires</a>
            <a href="index.php?action=actionsArticles" class="list-group-item list-group-item-action">Moderation des articles</a>
        </div><br/><br/><br/><br/>
<?php }require_once 'view/footer.php'; ?>
