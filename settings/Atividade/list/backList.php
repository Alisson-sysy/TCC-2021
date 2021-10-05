<?php

    $pathConnect = dirname(__FILE__) . "./../../../settings/connections/connect.php";
    include_once($pathConnect);


    if(isset($_POST["idTurma"])){
        $idTurma = $_POST["idTurma"];
    }else{
        $idTurma = $_GET["i"];
    }

    $sqlSelect = "SELECT * from atividade where id_turma = $idTurma";
    $resultado = mysqli_query($bd, $sqlSelect) or die(mysqli_error());

    $atividades = array();
    $x = 0;
    $aux = 0;

    while($dados = mysqli_fetch_assoc($resultado)){
        $div = "<div id='controle$aux'>";
        $div = $div."<div id='listaAtividade' onclick='muda($aux)'>";

        //pegar os dados do banco
        $idAtividade = $dados["id_atividade"];
        $nomeAtividade = $dados["nome_atividade"];
        $diaEntrega = $dados["dia_entrega"];
        $horaEntrega = $dados["hora_entrega"];
        $desc = $dados["desc_atv"];

        //adicionar informações
        $div = $div."<div class='prin'><span id='nomeAtv'  class='nomeAtv'>".$nomeAtividade."</span>";

        //btn para progresso das atividades
        $div = $div." <span>
            <form method='POST' action='/TCC/visualization/atividades/progresso/addProgressoFront.php'>
                <input type='hidden' name='addProg'>
                <input type='hidden' name='idTurma' value='$idTurma'>
                <input type='hidden' name='idAtividade' value='$idAtividade'>
                <input type='submit' value='Adicionar Progresso'>
            </form>
        ";

        $div = $div."
            <form method='POST' action='/TCC/visualization/atividades/progresso/viewProg.php'>
                <input type='hidden' name='verProg'>
                <input type='hidden' name='idTurma' value='$idTurma'>
                <input type='hidden' name='idAtividade' value='$idAtividade'>
                <input type='submit' value='Ver Progresso'>
            </form>
            </span>
        ";
        $div = $div."</div>";
        $div = $div."<span id='desc'>".$desc."<br>Data: ".$diaEntrega."<br>Hora: ".$horaEntrega."</span>";
        $div = $div."</div>";
        $div = $div."</div>";
        $atividades[$x] = $div;
        $x ++;
        $aux++;
    }

?>


<script>

    function muda(aux){
        const  lisAtv = document.getElementById('controle'+aux);
        
        lisAtv.classList.toggle('click');
    }

</script>