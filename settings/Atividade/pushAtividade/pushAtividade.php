<?php

    $pathBD = dirname(__FILE__) . "./../../connections/connect.php";
    include_once($pathBD);

    //inciar uma seção, se não houver outra em andamento
    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_POST["atv"])){

        //Pegar valores do front
        $nomeAtividade = $_POST["nomeAtividade"] != ""? mysqli_real_escape_string($bd, $_POST["nomeAtividade"]) : header("location: /TCC/visualization/Atividades/criarAtividade/createAtividade.php?error=1");
        $diaEntrega = $_POST["diaEntrega"] != ""? mysqli_real_escape_string($bd, $_POST["diaEntrega"]) : header("location: /TCC/visualization/Atividades/criarAtividade/createAtividade.php?error=1");
        $horaEntrega = $_POST["horaEntrega"] != ""? mysqli_real_escape_string($bd, $_POST["horaEntrega"]) : header("location: /TCC/visualization/Atividades/criarAtividade/createAtividade.php?error=1");
        $descAtv = $_POST["descAtv"] != ""? mysqli_real_escape_string($bd, $_POST["descAtv"]) : header("location: /TCC/visualization/Atividades/criarAtividade/createAtividade.php?error=1");
        $idTurma = $_POST["idTurma"] != ""? mysqli_real_escape_string($bd, $_POST["idTurma"]) : header("location: /TCC/visualization/Atividades/criarAtividade/createAtividade.php?error=1");
        $idUsuario = $_SESSION['id'];
        
        if($_POST["atv"] == "addAtv"){
            
            $sqlInsert = "INSERT INTO atividade (nome_atividade, dia_entrega, hora_entrega, id_turma, ID_usuario, desc_atv) values ('$nomeAtividade', '$diaEntrega', '$horaEntrega', $idTurma, $idUsuario, '$descAtv')";

            if(!mysqli_query($bd, $sqlInsert)){
                if ( mysqli_errno($bd) == 1062 ) {
                    $mensagem = "<h3>Prezado usuário o valor escolhido '$' já está sendo utilizado. Escolha outro!</h3>";
                } else {
                    $mensagem = "<h3>Ocorreu um erro ao inserir os dados: </h3> <h3>".mysqli_error($bd)."</h3> <h4>".mysqli_errno($bd)."</h4>";
                }
            }else{
                header("location: /TCC/visualization/Atividades/listAtividade/frontList.php?i=$idTurma");
            }
        }
    }

?>