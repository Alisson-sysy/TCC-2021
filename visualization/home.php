<?php include_once("../settings/connections/check_session.php");?>
<?php include_once("../settings/lembretes/list/lista.php");?>

<?php 
    $newLembrete = "";

    if(isset($_POST["new"])){
        if($_POST["new"] === "Novo Lembrete"){
            $newLembrete = '<form action="../settings/lembretes/push/pushLembretes.php" method="POST" class="formlem">
                <div class="novoAtv">
                    <textarea type="textarea" name="lembreteText"  class="inputtext" placeholder="EX: Fazer compras" required"></textarea>
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

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php
            
            $nome = $_SESSION['nome'];
            $sobrenome = $_SESSION['sobrenome'];

        ?>
        <div class='divImg'><div id='textoWelcome' class='textIMg'><p id='bemVenido'>Seja Bem vindo(a)</p><?php echo "<p id='nomeProf'>$nome $sobrenome</p>"?></div><img src="/TCC/img/testeimg.jpg" id='imgCabecalho' alt=""></div>
        <div class="resto">
            <div class="cabecalho" id="cabecalho">
                <?php include_once("menuHome.php");?>
            </div>
            <center>
                <main class='main'>
                        <h3 class='titulo'>Meus Lembretes</h3>
                        <?php echo $table?>
                        <?php echo $newLembrete?>

                    
                    <?php
                    
                        // if(!isset($_SESSION)){
                        //     session_start();
                        // }

                        // $idUsuario = $_SESSION['id'];

                        // $sqlSelect = "SELECT id_turma from usuario_turma 
                        //                 WHERE 
                        //                 ID_usuario = $idUsuario";

                        // $resultado = mysqli_query($bd, $sqlSelect) or die(mysqli_error($bd));

                        // $div = "<div class='minhasTurmas'>";
                        // $div = $div."<h3 class='titulo'>Minhas Turmas</h3>";
                        // while($dados = mysqli_fetch_assoc($resultado)){
                        //     $idTurma = $dados['id_turma'];

                        //     $sqlSelectTurma = "SELECT * from turma where id_turma = $idTurma";

                        //     $resultadoTurma = mysqli_query($bd, $sqlSelectTurma) or die(mysqli_error($bd));

                        //     $dadosTurma = mysqli_fetch_assoc($resultadoTurma);
                        //     $nome_turma = $dadosTurma['nome_turma'];

                        //     $div = $div.'<div class="turma">';
                        //     $div = $div."<p class='nomTurma'>$nome_turma</p>";
                        //     $div = $div.'<form method="POST">
                        //         <input type="hidden" name="verTuma">
                        //         <input type="hidden" name="turma" value='.$idTurma.'>
                        //         <input type="submit" value="Ver turmas" class="buttonTurma">
                        //     </form>';
                        //     $div = $div.'</div>';
                        // }

                        // $div = $div."</div>";
                        
                        // echo $div;
                    ?>
                    <div class='Welcome'>
                            <p class='tituDica'>Dicas do Sistema PROFIE!</p>
                            <p id='textoRandom'>O PROFIE tem o objetivo de ajudar você, professor, que está com dificuldade de lidar com seus compromissos no periodo de pandemia.</p>
                    </div>
                    <div class="rodape" id='rodape'>
                        <p class='logo'>PROFIE</p>
                        <p class='copyright'>© 2021 Alisson Garcia</p>
                        <p class='copyright'>© 2021 PROFIE</p>
                    </div>
                </main>
            </center>
        </div>
    </body>
    <script >
    var textos = ['Você pode acessar a lista de seus alunos clicando em: Turmas e em seguida em Alunos', 'Ao clicar em Plano mensal, você pode ver todos os planos mensais criados até o momento', 'Você pode clicar no botão de (+) e adicionar um novo lembrete, na tela principal do sistema', 'É possível ver mais informações sobre um aluno, clicando no botão "ver mais", na lista de alunos da turma', 'É possível ver as fotos dos trabalhos feitos por um aluno ao clicar na opção "ver foto" nas informações pessoais do mesmo'];
    var h = 0;
    setInterval(Function => {
        if(h>=textos.length){
            h = 0;
        }
        document.getElementById('textoRandom').style.opacity = 0;
        document.getElementById('textoRandom').style.WebkitTransition = "opacity .6s";
        setTimeout(() => {
            document.getElementById('textoRandom').style.opacity = 1;
            document.getElementById('textoRandom').innerHTML = textos[h];
            h++;
        }, 1000);
    }, 10000)

    function typeWrite(elemento, elemento2){
        const textoArray = elemento.innerHTML.split(''); 
        const nomeArray = elemento2.innerHTML.split('');
        elemento.innerHTML = '';
        setTimeout(() => {
            textoArray.forEach((letra, i) =>{
                setTimeout(() => {
                    elemento.innerHTML += letra;
                }, 75 * i);
            })
        }, 500);
        
        
        setTimeout(() => {
            elemento2.style.opacity = 1;
            elemento2.style.WebkitTransition = "opacity 1s";
        }, 1800);
    }

    const titulo  = document.getElementById('bemVenido');
    const nome  = document.getElementById('nomeProf');

    typeWrite(titulo, nome);

    const rodape  = document.getElementById('rodape');
    const posicaoRodape = rodape.getBoundingClientRect();

    var posicaoy = window.pageYOffset;

    alert(document.rodape.scrollTop);

    if(scroll.offsetTop == rodape.offsetTop){
        alert(sla);
    }

    </script>
</html>