<?php include_once 'view/header.php'; ?>
    <!-- FORMULAIRE ENREGISTREMENT NEW MEMBER
    ROUTER VOIT register ET APPEL DANS Controller newMemberRegister() QUI INSTANCIE Member PUIS MemberManager
    HASH LE password
    COMPTE NOMBRE DE CARACTERES
    ET CREE UN user PAR DEFAUT role 0-->
    <form id="form-contact" action="index.php?action=register" method="POST">
        <div class="form-row">
            <div class="form-group col-12 col-md-6">
            <h2 class="text-center">Creation de compte</h2>
            </div>
        </div>
        <div class="connexion">
            <label>Nom utilisateur</label>
            <input type="text" class="form-control" name="user" placeholder="Choisissez un nom d'utilisateur" required>
        </div>
            <div class="connexion">
                <label>Mot de passe</label>
                <input type="password" class="form-control" name="password" placeholder="Veuillez choisir votre mot de passe" required>
            </div>
            <div class="connexion">
                <label>Repeter votre mot de passe</label>
                <input type="password" class="form-control" name="repeatPasswordRegister" placeholder="Veuillez repeter votre mot de passe" required>
            </div>
            <div class="utilisateurInscrit">
                <a href="index.php?action=connexion">Je suis deja inscrit</a>
            </div>
        </div>
        <div class="col-lg-12 text-center">
            <button type="submit" class="btn btn-primary"  name="newMemberRegister" value="Valider">Valider</button>
        </div>
    </form>
<?php require_once 'view/footer.php'; ?>
