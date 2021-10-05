<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Londrina+Sketch&family=Poppins:wght@100&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/TCC/CSS/menu/menuHome.css">
    </head>
    <body>

    <header id='header'>
            <a href="/TCC/visualization/home.php" id='logo'>PROFIE</a>
            <nav id='nav'>
                <input type='button' id='btn-mobile' value='☰'>
                <ul id='menu'> 
                    <li><a class="nav-link active" aria-current="page" href="/TCC/visualization/home.php"><!--<img class='imgMenu' src='/TCC/CSS/imgCss/vector home.png'>-->Home</a></li>
                    <?php

                        if(!isset($_SESSION)){
                            session_start();
                        }

                        if ($_SESSION["tipo"] == "D"){
                            echo '<li><a class="nav-link" href="/TCC/visualization/front_list.php">Professores</a></li>
                            <li><a class="nav-link" href="/TCC/visualization/teacherRegister.php">Cadastro de professores</a></li>
                            <li><a class="nav-link" href="/TCC/visualization/turmas/create">Cadastro de Turmas</a></li>';
                        }
                    ?>
                    <li><a class="nav-link" href="/TCC/visualization/planoMensal/list/planoLista.php">Plano mensal</a></li>
                    <li><a class="nav-link" href="/TCC/visualization/turmas/lista/front_list.php">Turmas</a></li>
                    <li><a class="nav-link" href="/TCC/settings/connections/exit.php">Sair</a>  </li>
                </ul>
            </nav>
        </header>   
    </body>
    <script src='/TCC/JS/menu.js'></script>
</html>