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

    while($dados = mysqli_fetch_assoc($resultado)){
        $div = "<div>";

        //pegar os dados do banco
        $idAtividade = $dados["id_atividade"];
        $nomeAtividade = $dados["nome_atividade"];
        $diaEntrega = $dados["dia_entrega"];
        $horaEntrega = $dados["hora_entrega"];
        $desc = $dados["desc_atv"];

        //adicionar informações
        $div = $div."<p>Nome da Atividade:". $nomeAtividade."</p>";
        $div = $div."<p>Descrição:".$desc."</p>";
        $div = $div."<p>Data de entrega:".$horaEntrega."</p>";
        $div = $div."<p>Hora de entrega:".$diaEntrega."</p>";

        //btn para progresso das atividades
        $div = $div."
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
        ";

        $div = $div."<hr>";
        $div = $div."</div>";
        $atividades[$x] = $div;
        $x ++;
    }

?>