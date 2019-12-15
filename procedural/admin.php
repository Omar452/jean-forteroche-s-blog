<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("inclusions/head.php");?>
    <link rel="stylesheet" href="css/style-admin.css">
</head>

<body>
    <header><?php include("inclusions/header.php");?></header>

        <div id="main-admin">
        <form method="post" action="author.php">
            <label for="identifiant">Votre identifiant: </label>
            <input type="text" name="identifiant" required><br>
            <label for="pass">Votre mot de passe: </label>
            <input type="password" name="passwd" required><br>
            <input id="submit" type="submit">
        </form>
    </div>

    <footer><?php include("inclusions/footer.php");?></footer>
</body>
</html>