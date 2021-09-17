<?php
    include_once("../../../settings/alunos/lista/back_list.php");
?>

<!DOCTYPE html>
    <head>
        <title>Alunos</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/TCC/CSS/lista/listaProfessores.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Archivo+Narrow&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php include_once("../../men.php");?>

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