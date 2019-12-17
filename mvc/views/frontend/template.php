<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <meta name="description" content=<?= $description ?>>

    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">

    <!-- FONTS -->
    <script src="https://kit.fontawesome.com/94e02723f8.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">



    <!-- TINY MCE -->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/zxzv60b5q0gc5d3wbi9ezdafwuzak7bbql5pmuzmxut75dr8/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#chapter'
        });
    </script>

</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-black" id="mainNav">
        <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Jean Forteroche</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="index.php?action=home">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="index.php?action=chapters&amp;id=1">Chapitres</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#footer">Contact</a>
            </li>
            <?= $adminNav ?>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="index.php?action=login"><?= $login ?></a>
            </li>
            </ul>
        </div>
        </div>
    </nav>

    <?= $content ?>

    <!-- Footer -->
    <footer id="footer" class="bg-black small text-center text-white-50">
        <div class="d-flex justify-content-around py-2">
            <div class="container">
                <p>CONTACT</p>
                
                <a href="mailto:jeanforteroche@fictif.fr"><i class="far fa-envelope"></i> jeanforteroche@fictif.fr</a></li>
                
            </div>
            <div class="container">
                <p>RESEAUX SOCIAUX</p>
                <ul class="list-unstyled">
                    <li><a href="#"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
                </ul>
            </div>
            <div class="container">
                <p>INFOS UTILES</p>
                <ul class="list-unstyled">
                    <li><a href="#">Mentions légales</a></li>
                    <li><a href="#">Politique de confidentialité</a></li>
                </ul>
            </div>
        </div>
        
        <div class="container pt-3">
            Copyright &copy; Your Website 2019
        </div>
    </footer>

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="public/js/script.js"></script>

</body>
</html>