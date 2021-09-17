
<script>
    function confirma(caminho){  
        alert("Apagar um professor? Tem certeza sobre isso?");
        confirm = confirm('Se você apagar esse professor(a), todas as obervações, turmas entre outras informações lincadas a ele(a), serão apagados também');
        if(confirm){
            window.location.href = "/TCC/settings/back_list.php?id="+caminho;
        }else{
            window.location.href = "/TCC/visualization/front_list.php";
        }   
    }
</script>
<!DOCTYPE html>
    <head>
        <title>Home page</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="#">
        <link rel="stylesheet" href="/TCC/CSS/lista/listaProfessores.css">
    </head>
    <body>
        <!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Londrina+Sketch&family=Poppins:wght@100&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/TCC/CSS/menu/menu.css">
    </head>
    <body>
        <header id='header'>
            <a href="/TCC/visualization/home.php" id='logo'>PROFIE</a>
            <nav id='nav'>
                <input type='button' id='btn-mobile' value='☰'>
                <ul id='menu'> 
                    <li><a class="nav-link active" aria-current="page" href="/TCC/visualization/home.php"><!--<img class='imgMenu' src='/TCC/CSS/imgCss/vector home.png'>-->Home</a></li>
                    <br />
<b>Notice</b>:  Undefined index: tipo in <b>C:\xampp\htdocs\TCC\visualization\men.php</b> on line <b>25</b><br />
                    <li><a class="nav-link" href="/TCC/visualization/planoMensal/list/planoLista.php">Plano mensal</a></li>
                    <li><a class="nav-link" href="/TCC/visualization/turmas/lista/front_list.php">Turmas</a></li>
                    <li><a class="nav-link" href="/TCC/settings/connections/exit.php">Sair</a>  </li>
                </ul>
            </nav>
        </header>
    </body>
    <script src='/TCC/JS/menu.js'></script>
</html>        <a href="home.php">Voltar</a>
        

        <fieldset class="lista" id="lista">
            <form method = 'POST'>
                    <label for='searching'>Procurar</label>
                    <input type='text' name='searching-input' id='searching' value=' '>
                    <input type='submit' name='searching' value='Procurar'>
                </form><div id='classItem'><p>Alisson</p><p>garica</p><p>Diretor</p><p></p><input type='button' id='btn' name='acao' value='excluir' onclick='confirma(1)'> <form action='../visualization/teacherRegister.php' method='POST'>
                            <input type='hidden' name='valor' value='1'>
                            <input type='submit' name='acao' id='btn' value='editar'>
                        </form></div><div id='classItem'><p>Alisson</p><p>garcia da rosa</p><p>Professor</p><p>Turma - 34</p><input type='button' id='btn' name='acao' value='excluir' onclick='confirma(4)'> <form action='../visualization/teacherRegister.php' method='POST'>
                            <input type='hidden' name='valor' value='4'>
                            <input type='submit' name='acao' id='btn' value='editar'>
                        </form></div><div id='classItem'><p>Ellén</p><p>Borges</p><p>Professor</p><p>Turma - 34</p><input type='button' id='btn' name='acao' value='excluir' onclick='confirma(2)'> <form action='../visualization/teacherRegister.php' method='POST'>
                            <input type='hidden' name='valor' value='2'>
                            <input type='submit' name='acao' id='btn' value='editar'>
                        </form></div><div id='classItem'><p>jaum</p><p>jaum</p><p>Professor</p><p>Turma - 34</p><input type='button' id='btn' name='acao' value='excluir' onclick='confirma(3)'> <form action='../visualization/teacherRegister.php' method='POST'>
                            <input type='hidden' name='valor' value='3'>
                            <input type='submit' name='acao' id='btn' value='editar'>
                        </form></div>        </fieldset>

        <p></p>    </body>
</html>