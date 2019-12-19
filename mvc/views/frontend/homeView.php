<?php
$title = "Page d'accueil - Jean Forteroche : Billet simple pour l'Alaska.";
$description = "Site du roman Billet simple pour l'Alaska du célèbre écrivain et acteur Jean Forteroche.";
?>

<?php ob_start(); ?>

<!-- Header -->
<header class="masthead">
    <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
        <h1 class="mx-auto my-0 text-uppercase">Billet simple pour l'Alaska</h1>
        <p class="text-white-70 mx-auto mt-2 mb-5">
            Découvrez en exclusivité sur ce site, mon tout dernier roman : "Billet simple pour l'Alaska".<br>
            Chaque semaine, je publie un nouveau chapitre, afin de faire perdurer le suspens à la manière des séries télévisées.<br>
            Alors, êtes vous pret à vous envoler pour l'Alaska?
        </p>
    
        <a href="index.php?action=chapters&amp;id=1" class="btn btn-primary js-scroll-trigger">Embarquez ici</a>
        </div>
    </div>
</header>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>