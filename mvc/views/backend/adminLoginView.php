<?php
$title = "Page de connexion - Jean Forteroche : Billet simple pour l'Alaska.";
$description = "Page de connexion réservée à l'administrateur du site";
?>

<?php ob_start(); ?>

<div id="form-connexion-div">
    <div>
        <form class="text-center" method="post" action="index.php?action=login">
            <?php
            if (isset($_SESSION["error"]))
            {
            ?>
                <div id="formError" class="container text-center">
                    <p id="error-msg">Identifiant ou mot de passe incorrect</p>
                </div> 
            <?php
            unset($_SESSION["error"]);
            }
            ?>
            <input type="text" class="form-control" name="adminLogin" placeholder="Votre identifiant" required><br>
            <input type="password" class="form-control" name="adminPassword" placeholder="Votre mot de passe" required><br>
            <input class="btn btn-primary" type="submit" value="Se connecter">
            <div id="formFooter">
                <a style="color:red;" class="underlineHover" href="#">Mot de passe oublié?</a>
            </div>  
        </form>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>