<?php include_once("../settings/check_session.php");?>
<!DOCTYPE html>
    <head>
        <title>Home page</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../CSS/home_css.css">
        <?php include_once("menu.php");?>
    </head>
    <body>

        <div class="cabecalho" id="cabecalho">


        </div>

        <?php
        
            if( $_SESSION["tipo"] == "D"){
                $text_page = "Olá ". $_SESSION["nome"];
            }else{
                $text_page = "Olá ". $_SESSION["nome"];
            }

            echo "<h1>".$text_page."<h1/>";
        ?>

    </body>
</html>