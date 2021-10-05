<?php 
    include_once("../../../settings/connections/connect.php");
    include_once("../../../settings/planoMensal/list/backList.php");

?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8"/>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Archivo+Narrow&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="/TCC/CSS/planoMensal/listaPlanoMensal.css">
        <title>Plano mensal</title>
    </head>
    <body>
        <?php include_once("../../men.php");?>
        <div class="main">
            <h1>Plano Mensal</h1>
            <?php echo $div;?>
        </div>
        <?php
        
            if(!isset($_SESSION)){
                session_start();
            }

            if($_SESSION['tipo'] == "D"){
                echo "<a href='/TCC/visualization/planoMensal/createPlano/createPlano.php' id='novoPlano'><span class='content'>+</span></a>";
            }

        ?>
        
    </body>
<html>