<?php include_once("../settings/connections/check_session.php");?>
<?php include_once("../settings/lembretes/list/lista.php");?>

<?php 
    $newLembrete = "";

    if(isset($_POST["new"])){
        if($_POST["new"] === "Novo Lembrete"){
            $newLembrete = '<form action="../settings/lembretes/push/pushLembretes.php" method="POST" class="formlem">
                <div class="novoAtv">
                    <input name="lembreteText" class="inputtext" value="" placeholder="Titulo" required>
                    <textarea type="textarea" name="lembreteBody"  class="inputtextBody"  placeholder="Conteudo"></textarea> 
                    <input type="submit" name="add"  class="inputtextBtn" value="Adicionar lembrete">
                </div>
            </form>';
        }
    }
    
    if(isset($_POST["verTuma"])){
        $id = $_POST["turma"];
        header("location: http://localhost/TCC/settings/alunos/lista/back_list.php?id=$id");
    }

?>

<!DOCTYPE html>
    <head>
        <title>Home page</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/TCC/CSS/home/home.css">
        <link rel="stylesheet" type="text/css" href="../CSS/home_css.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Londrina+Sketch&family=Poppins:wght@100&display=swap" rel="stylesheet">
    </head>
    <body>

        <div class="cabecalho" id="cabecalho">
            <?php include_once("men.php");?>
        </div>
        <center>
            <main class='main'>

                    <h3 class='titulo'>Meus Lembretes</h3>
                    <?php echo $table?>
                    <?php echo $newLembrete?>
 
                
                <?php
                
                    if(!isset($_SESSION)){
                        session_start();
                    }

                    $idUsuario = $_SESSION['id'];

                    $sqlSelect = "SELECT id_turma from usuario_turma 
                                    WHERE 
                                    ID_usuario = $idUsuario";

                    $resultado = mysqli_query($bd, $sqlSelect) or die(mysqli_error($bd));

                    $div = "<div class='minhasTurmas'>";
                    $div = $div."<h3 class='titulo'>Minhas Turmas</h3>";
                    while($dados = mysqli_fetch_assoc($resultado)){
                        $idTurma = $dados['id_turma'];

                        $sqlSelectTurma = "SELECT * from turma where id_turma = $idTurma";

                        $resultadoTurma = mysqli_query($bd, $sqlSelectTurma) or die(mysqli_error($bd));

                        $dadosTurma = mysqli_fetch_assoc($resultadoTurma);
                        $nome_turma = $dadosTurma['nome_turma'];

                        $div = $div.'<div class="turma">';
                        $div = $div."<p class='nomTurma'>$nome_turma</p>";
                        $div = $div.'<form method="POST">
                            <input type="hidden" name="verTuma">
                            <input type="hidden" name="turma" value='.$idTurma.'>
                            <input type="submit" value="Ver turmas" class="buttonTurma">
                        </form>';
                        $div = $div.'</div>';
                    }

                    $div = $div."</div>";
                    
                    echo $div;
                ?>
            </main>
        </center>
    </body>
    <script src='/TCC/JS/home.js'></script>
</html>