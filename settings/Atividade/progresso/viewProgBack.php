<?php

    $pathConnect = dirname(__FILE__) . "./../../../settings/connections/connect.php";
    include_once($pathConnect);

    if(isset($_POST['idTurma'])){
        $idTurma = $_POST['idTurma'];
        $idAtividade = $_POST['idAtividade'];
    }else{
        $idTurma = $_GET['it'];
        $idAtividade = $_GET['ia'];
    }

    $sqlSelectAllAlunos = "select id_aluno from aluno where id_turma = $idTurma";
    $resultadoAluno = mysqli_query($bd, $sqlSelectAllAlunos) or die(mysqli_errno());

    $sqlSelectEntrega = "select id_aluno from entrega where id_atividade = $idAtividade";
    $resultadoEntrega = mysqli_query($bd, $sqlSelectEntrega) or die(mysqli_errno());
    $qtdResultado = mysqli_num_rows($resultadoEntrega);

    $h = 0;
    $fez = array();
    $nFez = array();
    $valoresAlunoEntrega = array();
    

    while($dadosEntrega = mysqli_fetch_assoc($resultadoEntrega)){
        $id_alunoEntrega = $dadosEntrega["id_aluno"];
        $valoresAlunoEntrega[$h] = $id_alunoEntrega;   
        $h++;
    }

    
    while($dados = mysqli_fetch_assoc($resultadoAluno)){
            $id_aluno = $dados["id_aluno"];
            $count = 0;

            for($x=0;$x<count($valoresAlunoEntrega);$x++){
                if($id_aluno == $valoresAlunoEntrega[$x]){
                    $count ++; 
                }
            }

            if($count > 0){
                $fez[count($fez)] = $id_aluno;  
            }else{
                $nFez[count($nFez)] = $id_aluno;
            }
    }

    $div = "<div id='progAluno'>";
    //se todos os alunos já fizeram as atividades, mostre 'Tarefa Finalizada'
    if(count($nFez) < 1){
        $div = $div.'<div class="end">Tarefa Finalizada</div>';
    }else{
        $div = $div.'<div class="mid">Tarefa Pendente</div>';
    }

    $div = $div.'<p class="divTxt">Alunos que fizeram a atividade</p>';

    for($a=0;$a<count($fez);$a++){
        $sqlSelect = "SELECT * from aluno where id_aluno = $fez[$a]";
        $sqlAlunoFez = mysqli_query($bd, $sqlSelect) or die(mysqli_errno());
        $dadosAlunoFez = mysqli_fetch_assoc($sqlAlunoFez);
        $nomeAluno = $dadosAlunoFez['nome'];
        $sobrenome = $dadosAlunoFez['sonbrenome'];

        // informações da entrega
        $sqlEntrega = "SELECT * from entrega where id_aluno = $fez[$a] and id_atividade = $idAtividade";
        $sqlAlunoFez = mysqli_query($bd, $sqlEntrega) or die(mysqli_errno());
        $infoEntrega = mysqli_fetch_assoc($sqlAlunoFez);
        $horaEntrega = $infoEntrega["hora_entrega"];
        $diaEntrega = $infoEntrega["dia_entrega"];

        $div = $div."<div id='aluno'>";
        $div = $div."<p id='nomeAluno'>$nomeAluno $sobrenome</p>";
        $div = $div."
            <p id='nomeAluno'>Dia: $diaEntrega</p>
            <p id='nomeAluno'>Hora: $horaEntrega</p>
            ";
        
        $div = $div."</div>";
    }

    $div = $div.'<p class="divTxt">Alunos que não fizeram a atividade</p>';
    for($b=0;$b<count($nFez);$b++){
        $sqlSelect = "SELECT * from aluno where id_aluno = $nFez[$b]";
        $sqlAlunoFez = mysqli_query($bd, $sqlSelect) or die(mysqli_errno());
        $dadosAlunoFez = mysqli_fetch_assoc($sqlAlunoFez);
        $nomeAluno = $dadosAlunoFez['nome'];
        $sobrenome = $dadosAlunoFez['sonbrenome'];
        $div = $div."<div id='aluno'>";
        $div = $div."<p id='nomeAluno'>$nomeAluno $sobrenome</p>";
        $div = $div."</div>";
    }
    if(count($nFez) == 0){
        $div = $div."<div id='aluno'>";
        $div = $div."<p id='nomeAlunoN'>Todos os alunos
        </p> <p id='nomeAlunoN'>Fizeram as atividades</p>";
        $div = $div."</div>";
    }

    $div = $div."</div>";

?>