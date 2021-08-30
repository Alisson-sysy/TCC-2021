<?php
    include_once("../../../settings/turma/lista/back_listTurma.php");
    include_once("../../../settings/connections/check_session.php");
?>

<!DOCTYPE html>
    <head>
        <title>Home page</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="#">
    </head>
    <body>
        <?php include_once("../../menu.php");?>
        <a href="home.php">Voltar</a>
        
        <?php
            // echo $pesquisar;
        ?>

        <fieldset class="lista" id="lista">
            <?php   
                echo $table;
            ?>
        </fieldset>

        <?php

            $mensagem = "";

            if(isset($_GET["confi"]) && $_GET["confi"] === "1"){
                $mensagem = "Dados salvos com sucesso";
            }

            echo "<p>$mensagem</p>"

            
        ?>
    </body>
</html>