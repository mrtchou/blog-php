<?php require_once 'view/header.php';?>
<!-- FORM POUR CONNEXION APPEL LA FUNCTION is_member() PUIS authentication() DANS Controller -->
<form method="post" action="index.php?action=login">
    <div class="form-row">
        <div class="form-group col-12 col-md-12">
        <h2>Remplissez le formulaire ci-dessous pour vous connecter:</h2>
        </div>
    </div>
    <div class="connexion">
        <label>votre nom utilisateur</label>
        <input type="text" name="member_name" class="form-control" placeholder="pseudo..." required>
    </div>
    <div class="connexion">
        <label>Votre mot de passe</label>
        <input type="password" name="checkPassword" class="form-control" placeholder="pass..." required>
    </div>
    <input type="submit" name="valider" class="btn btn-primary">
</form>
<?php require_once 'view/footer.php'; ?>
