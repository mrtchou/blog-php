<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil | Le blog professionnel</title>
    <meta name="description" content="Bienvenue sur mon blog professionnel." />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <!-- règles CSS et CDN -->
    <!-- <link rel="stylesheet" href="../../public/css/frontend.css"> essai en local -->
    <link rel="stylesheet" href="public/css/frontend.css">
    <link href="https://fonts.googleapis.com/css?family=Exo:300,400,700|Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
<?php if(empty($_SESSION))
        {?>
            <div id="bloc-page">
                <nav id="navbar-example2" class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
                    <!-- le navbar-expand-md permet de décider quand le menu collapse -->
                    <div class="container">
                        <a class="navbar-brand text-white-50 text-uppercase" href="index.php">Accueil</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span></button>
                        <ul class="nav collapse navbar-collapse flex-sm-column flex-md-row justify-content-md-end align-items-sm-start" id="navbarToggler">
                            <li class="nav-item">
                                <a class="nav-link text-white text-uppercase" href="index.php?action=contact">Contact</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white text-uppercase" href="index.php?action=cv">CV</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-red" href="index.php?action=connexion">Connexion</a>
                            </li>
                        </ul>
                    </div>
                </nav><br><br><br>
                <header id="home-header">
                    <div class="container">
                        <div class="row home-alaska">
                            <div class="col-lg-6 offset-lg-3 text-center">
                                <a href="index.php?action=listArticles" class="d-block d-md-inline-block btn btn-lg btn-secondary mb-3" role="button">Accéder aux articles en ligne</a>
                            </div>
                        </div>
                    </div>
                </header>
<p class="text-right">
<?php
      }
      if(empty($_SESSION))
      {
      echo 'Vous n\'etes pas connecté';
      }
?>
</p>
<?php if(!empty($_SESSION))
        {?>
        <div id="bloc-page">
            <nav id="navbar-example2" class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
                <!-- le navbar-expand-md permet de décider quand le menu collapse -->
                <div class="container">
                    <a class="navbar-brand text-white-50 text-uppercase" href="index.php">Accueil</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span></button>
                    <ul class="nav collapse navbar-collapse flex-sm-column flex-md-row justify-content-md-end align-items-sm-start" id="navbarToggler">
                        <li class="nav-item">
                            <a class="nav-link text-white text-uppercase" href="index.php?action=contact">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white text-uppercase" href="index.php?action=cv">CV</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white text-uppercase" href="index.php?action=listArticles">Liste des articles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-red" href="index.php?action=deconnexion">DECONNEXION</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <hr/><hr/><br>
            <header id="home-header">
                <p class="text-right">
                <?php
                        //AFFICHAGE SESSION SI NON EMPTY AVEC bienvenue
                        if(!empty($_SESSION)){
                        echo '<em>Bienvenue ' . $_SESSION['member_name'] . ' <br/>'. $_SESSION['messageSuccesConnexion'] . '</em>';
                        }
                ?>
                </p>
            </header>
<?php   } ?><hr/><br/>
