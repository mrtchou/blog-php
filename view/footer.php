<br><br><br><br><hr/>
<footer>
    <div class="container">
        <div class="row">
            <div class="text-center mb-5 col-8 offset-2 text-md-left col-md-4 offset-md-0">
                <h5 class="text-uppercase">Plan du site</h5>
                <div>
                    <a href="index.php" class="text-black">Accueil</a><br />
                    <a href="index.php?action=curruculumVitae" class="text-black">CV</a><br />
                    <a href="index.php?action=listArticles" class="text-black">Liste des articles du blog</a><br />
                    <a href="index.php?action=contact" class="text-black">Contact</a><br />
                </div>
            </div>
    <div class="text-center mb-5 col-8 offset-2 text-md-left col-md-4 offset-md-0">
        <h5 class="text-uppercase">Me retrouver sur</h5>
        <div>
            <a href="https://www.facebook.com" title="Page Facebook du développeur du site" class="text-black">Facebook</a><br />
            <a href="https://twitter.com" title="Compte Twitter du développeur du site" class="text-black">Twitter</a><br />
        </div>
    </div>
    <?php /// Connexion Register Deconnecxion au pied de page selon si member ou pas
        if(!empty($_SESSION))
        {
            ?>
                <div class="text-center mb-5 col-8 offset-2 text-md-left col-md-4 offset-md-0">
                    <div>
                        <a href="index.php?action=deconnexion" class="text-black">Se deconecter</a>
                    </div>
            <?php
            if(isset($_SESSION['role']) AND ($_SESSION['role'] == 1))
            {
                ?>
                    <div>
                        <a href="index.php?action=dashboard" class="text-black">Espace Administration</a>
                    </div>
                </div>
                <?php
            }
        }
        else
        {
            ?>
            <div class="text-center mb-5 col-8 offset-2 text-md-left col-md-4 offset-md-0">
                <h5 class="text-uppercase">Compte</h5>
                <div>
                    <a href="index.php?action=register" class="text-black">S'enregistrer</a>
                </div>
                <div>
                    <a href="index.php?action=connexion" class="text-black">Se connecter</a>
                </div>
            </div>
            <?php
        }
    ?>
    </div>
    </div>
    <hr/>
        <p class="m-0 text-center">Copyright &copy; Tchoutchaiev 2021</p>
    <hr/>
</footer>
</body>
</html>
