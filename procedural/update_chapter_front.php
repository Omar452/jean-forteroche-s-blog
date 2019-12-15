<?php session_start();?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <?php include("inclusions/head.php");?>
        <link rel="stylesheet" href="css/style-update-chapters.css">
        
        <!--TINY MCE-->
        <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">
        <script src="https://cdn.tiny.cloud/1/zxzv60b5q0gc5d3wbi9ezdafwuzak7bbql5pmuzmxut75dr8/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
        tinymce.init({
            selector: '#chapter'
        });
        </script>

    </head>

    <body>
        <header><?php include("inclusions/header.php");?></header>

        <div id="main">

                <div id="update-chapter-div">
                    <form method="post" action='backend/update_chapter_back.php?id=<?php echo $_GET["id"]?>'>
                        <p>Modifier le chapitre</p>
                        <label for="title">Modifier le titre du chapitre:</label>
                        <input id="title" type="text" name="title"><br>
                        <label for="chapter">Modifier le contenu du chapitre:</label>
                        <textarea id="chapter" name="chapter" rows=20></textarea><br>
                        <input id="submit" type="submit">
                    </form>
                </div>

        </div>

        <footer><?php include("inclusions/footer.php");?></footer>

    </body>

</html>