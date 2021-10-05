

<?php

    $pathBack = dirname(__FILE__) . "./../../../settings/atividade/progresso/viewProgBack.php";
    include_once($pathBack);

    $pathMenu = dirname(__FILE__) . "./../../men.php";
    include_once($pathMenu);
    
    

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/TCC/CSS/progressoP/progresso.css">

        <!-- Fontes -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Archivo+Narrow&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
        <title>Progresso dos alunos</title>
    </head>
    <body>
        <main class='main'>
            <?php echo $div;?>
        </main>
    </body>
</html>