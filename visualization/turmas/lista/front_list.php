<?php
    include_once("../../../settings/turma/lista/back_listTurma.php");
    include_once("../../../settings/connections/check_session.php");
?>

<!DOCTYPE html>
    <head>
        <title>Home page</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/TCC/CSS/lista/listaProfessores.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Archivo+Narrow&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php include_once("../../men.php");?>
        
        <?php
            // echo $pesquisar;
        ?>

        <fieldset class="lista" id="lista" id='form'>
            <?php  
                echo "<div id='head'>";
                    echo '<p id="listaText">Lista de turmas</p>';
                echo "</div>"; 
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