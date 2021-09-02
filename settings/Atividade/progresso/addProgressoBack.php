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

    $x = 0;
    $h = 0;
    $aux = 0;
    $valores = array();
    $valoresAlunoEntrega = array();
    $img = '';

    if(isset($_FILES['img'])){
        header("location:  http://localhost/TCC/visualization/atividades/progresso/addProgressoFront.php?ia=$idAtividade&&it=$idTurma&&i=s");
        $aux = 0;
    }else{
        $img = '/TCC/settings/atividade/fotosAtv/default.png';
    }

    if(isset($_GET['i'])){
        $img = $_FILES['img'];
    }

    
    if($qtdResultado == 0){
        $div = "<div>";
            $sqlSelect = "select * from aluno where id_turma = $idTurma";
            $resultado = mysqli_query($bd, $sqlSelect) or die(mysqli_errno());
            
            while($dados = mysqli_fetch_assoc($resultado)){
                $nome = $dados["nome"];
                $sobrenome = $dados["sonbrenome"];
                $id = $dados['id_aluno'];
                $feito = 
                "  
                <form method='POST' action='/TCC/settings/Atividade/progresso/addProgressoBack.php?ia=$idAtividade&&it=$idTurma'>
                    <input type='hidden' name='feito'>
                    <input type='hidden' name='aluno' value='$id'>
                    <input type='hidden' name='conf'>
                    <input type='submit' value='✓'>
                </form>
                ";

                $nFeito = 
                "  
                <form method='POST' action='/TCC/settings/Atividade/progresso/addProgressoBack.php?ia=$idAtividade&&it=$idTurma'>
                    <input type='hidden' name='nFeito' >
                    <input type='hidden' name='aluno' value='$id'>
                    <input type='hidden' name='conf'>
                    <input type='submit' value='✗'>
                </form>
                ";

                $addFoto = "
                <form method='POST' enctype='multipart/form-data' action='/TCC/settings/Atividade/progresso/addProgressoBack.php?ia=$idAtividade&&it=$idTurma'>
                    <input type='hidden' name='aluno' value='$id'>
                    <input type='hidden' name='atividade' value='$idAtividade'>
                    <label for='img'><img src='/TCC/settings/atividade/fotosAtv/default.png' width='300px' ></label>
                    <input type='FILE' id='img' name='img' onchange='form.submit()' hidden>
                </form>
                ";


                $div = $div."<p>".$nome." ".$sobrenome." ".$feito." ".$nFeito." ". $addFoto."</p>";
            }
        $div = $div."</div>";

    }else{

        while($dadosEntrega = mysqli_fetch_assoc($resultadoEntrega)){
            $id_alunoEntrega = $dadosEntrega["id_aluno"];
            $valoresAlunoEntrega[$h] = $id_alunoEntrega;
            $h++;
        }

        $chegou = "aqui";
        while($dados = mysqli_fetch_assoc($resultadoAluno)){
            $aux = 0;
            $id_aluno = $dados["id_aluno"];
            for($c=0;$c<count($valoresAlunoEntrega);$c++){
                if($valoresAlunoEntrega[$c] == $id_aluno){
                    $aux ++;
                }
            }
            if($id_aluno == $id_alunoEntrega){
                $aux ++;
            }
            if($aux == 0){
                $valores[$x] = $id_aluno;
                $x++;
            }
        }

        $div = "<div>";
        for($y=0;$y<count($valores);$y++){
            $sqlSelect = "select * from aluno where id_aluno = $valores[$y]";
            $resultado = mysqli_query($bd, $sqlSelect) or die(mysqli_errno());
            while($dados = mysqli_fetch_assoc($resultado)){
                $nome = $dados["nome"];
                $sobrenome = $dados["sonbrenome"];
                $id = $dados['id_aluno'];
                $feito = 
                "  
                <form method='POST' action='/TCC/settings/Atividade/progresso/addProgressoBack.php?ia=$idAtividade&&it=$idTurma'>
                    <input type='hidden' name='feito'>
                    <input type='hidden' name='aluno' value='$id'>
                    <input type='hidden' name='conf'>
                    <input type='submit' value='✓'>
                </form>
                ";

                $nFeito = 
                "  
                <form method='POST'  action='/TCC/settings/Atividade/progresso/addProgressoBack.php?ia=$idAtividade&&it=$idTurma'>
                    <input type='hidden' name='nFeito'>
                    <input type='hidden' name='aluno' value='$id'>
                    <input type='hidden' name='conf' value='E'>
                    <input type='submit' value='✗'>
                </form>
                ";

                $addFoto = "
                <form method='POST' enctype='multipart/form-data' action='/TCC/settings/Atividade/progresso/addProgressoBack.php?ia=$idAtividade&&it=$idTurma'>
                    <input type='hidden' name='foto'>
                    <input type='hidden' name='aluno' value='$id'>
                    <input type='hidden' name='atividade' value='$idAtividade'>
                    <label for='img'><img src='/TCC/settings/atividade/fotosAtv/default.png' width='300px' ></label>
                    <input type='file' id='img' name='img' onchange='form.submit()' hidden>
                </form>
                ";


                $div = $div."<p>".$nome." ".$sobrenome." ".$feito." ".$nFeito." ". $addFoto."</p>";
            }
        }
        $div = $div."</div>";
        if(count($valores) == 0){
            $div = "Todos os alunos Já entregaram as atividades";
        }
    }


    //Adicionar entrega de tarefa

    $sim = $img;

    if(isset($_POST['conf'])){
        $id_aluno = $_POST['aluno'];
        
        if(isset($_POST['feito'])){
            $fez = 'E';
        }else{
            $fez = 'N';
        }


        // $sqlInsert = "insert into entrega (id_atividade, id_aluno, foto, confirmacao, dia_entrega, hora_entrega)
        // values ($idAtividade, $id_aluno, '$img', '$fez', '".date('H:i:s')."', '".date('Y-d-m')."')";

        // mysqli_query($bd, $sqlInsert) or die(mysqli_error($bd)."$idAtividade");
        $sqlInsert = "insert into entrega (id_atividade, id_aluno, confirmacao, dia_entrega, hora_entrega)
        values ($idAtividade, $id_aluno, '$fez', '".date('H:i:s')."', '".date('Y-d-m')."')";

        mysqli_query($bd, $sqlInsert) or die(mysqli_error($bd)."$idAtividade");

        header("location:  http://localhost/TCC/visualization/atividades/progresso/addProgressoFront.php?ia=$idAtividade&&it=$idTurma");

    }


    
    
?>