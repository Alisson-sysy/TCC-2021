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

    $div = "<div>";
    //se todos os alunos já fizeram as atividades, mostre 'Tarefa Finalizada'
    if(count($nFez) < 1){
        $div = $div.'<h5>Tarefa Finalizada</h5>';
    }else{
        $div = $div.'<h5>Tarefa Pendente</h5>';
    }

    $div = $div.'<br>Alunos que fizeram a atividade<br>';

    for($a=0;$a<count($fez);$a++){
        $sqlSelect = "SELECT * from aluno where id_aluno = $fez[$a]";
        $sqlAlunoFez = mysqli_query($bd, $sqlSelect) or die(mysqli_errno());
        $dadosAlunoFez = mysqli_fetch_assoc($sqlAlunoFez);
        $nomeAluno = $dadosAlunoFez['nome'];

        $div = $div."Nome: $nomeAluno<br>";
    }

    $div = $div.'<br>Alunos que não fizeram a atividade<br>';
    for($b=0;$b<count($nFez);$b++){
        $sqlSelect = "SELECT * from aluno where id_aluno = $nFez[$b]";
        $sqlAlunoFez = mysqli_query($bd, $sqlSelect) or die(mysqli_errno());
        $dadosAlunoFez = mysqli_fetch_assoc($sqlAlunoFez);
        $nomeAluno = $dadosAlunoFez['nome'];

        $div = $div."Nome: $nomeAluno<br>";
    }

    $div = $div."</div>";

?>