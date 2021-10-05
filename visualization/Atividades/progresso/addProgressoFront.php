<?php

    $pathBack = dirname(__FILE__) . "./../../../settings/atividade/progresso/addProgressoBack.php";
    include_once($pathBack);

    $pathBack = dirname(__FILE__) . "./../../men.php";
    include_once($pathBack);

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/TCC/CSS/progressoP/addProg.css">
    
    <!-- fonte -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Narrow&display=swap" rel="stylesheet">
    
    <title>Document</title>
</head>
<body>
    <main class='main'>
        <?php echo $div;?>
    </main>
</body>
</html>