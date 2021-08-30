<?php
    include_once("../../../settings/alunos/lista/back_list.php");
?>

<!DOCTYPE html>
    <head>
        <title>Alunos</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="#">
    </head>
    <body>
        <?php include_once("../../menu.php");?>

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