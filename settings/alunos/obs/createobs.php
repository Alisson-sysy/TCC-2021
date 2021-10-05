<?php
    //include do BD
    include_once("../../../settings/connections/connect.php");
    
    // include_once("../../../

    if(isset($_POST["acao"])){
        $idAluno = $_POST["idAluno"] != " " ? mysqli_real_escape_string($bd, $_POST["idAluno"]): header("location: /TCC/visualization/turmas/create/index.php?error=1");
        $obsCtt = $_POST["obsCtt"] != " " ? mysqli_real_escape_string($bd, $_POST["obsCtt"]): header("/TCC/visualization/alunos/obsAluno/createObs.php?error=1");

        if(isset($_POST['do']) && $_POST['do'] == "criarObs"){

            $sql_code = "INSERT INTO observacoes (id_aluno, observacao)
                VALUES
            ($idAluno, '$obsCtt')";

            if(!mysqli_query($bd, $sql_code)){

                if ( mysqli_errno($bd) == 1062 ) {
                    $mensagem = "<h3>Prezado usuário o valor escolhido '$' já está sendo utilizado. Escolha outro!</h3>";
                } else {
                    $mensagem = "<h3>Ocorreu um erro ao inserir os dados: </h3> <h3>".mysqli_error($bd)."</h3> <h4>".mysqli_errno($bd)."</h4>";
                }
            }else{
                header("location: /TCC/visualization/alunos/maisInfo/maisInfo.php?id=$idAluno");
            }
        }
    } 
?>