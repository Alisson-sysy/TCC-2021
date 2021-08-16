<?php
    include_once("../../../settings/connect.php");
    // include_once("../../../

    if(isset($_POST["acao"])){
        $nomeTurma = isset($_POST["turmaNome"]) ? mysqli_real_escape_string($bd, $_POST["turmaNome"]): header("location: /TCC/visualization/turmas/create/index.php?error=1");
        $periodo = isset($_POST["periodo"]) ? mysqli_real_escape_string($bd, $_POST["periodo"]) : header("location: /TCC/visualization/turmas/create/index.php?error=1");
        $id = isset($_POST["id"])? mysqli_real_escape_string($bd, $_POST["id"]): header("/TCC/visualization/turmas/create/index.php?error=1");
        if($_POST["acao"] == "Criar Turma"){
            header("location: /TCC/visualization/turmas/create/index.php?error=1");

            $sql_code = "INSERT INTO turma (nome_turma, periodo)
                         VALUES
                         ('$nomeTurma', '$periodo')";
                        
            if(!mysqli_query($bd, $sql_code)){

                if ( mysqli_errno($bd) == 1062 ) {
                    $mensagem = "<h3>Prezado usuário o valor escolhido '$' já está sendo utilizado. Escolha outro!</h3>";
                } else {
                    $mensagem = "<h3>Ocorreu um erro ao inserir os dados: </h3> <h3>".mysqli_error($bd)."</h3> <h4>".mysqli_errno($bd)."</h4>";
                }
            }else{
                header("location: /TCC/visualization/turmas/create/index.php?error=0");
            }
        }else if($_POST["acao"] == "Salvar"){
            echo "$id";

            $sql_code = "UPDATE turma SET
                            nome_turma = '$nomeTurma',
                            periodo = '$periodo'
                        where
                            id_turma = $id";

            if(!mysqli_query($bd, $sql_code)){
                if ( mysqli_errno($bd) == 1062 ) {
                    $mensagem = "<h3>Prezado usuário o valor escolhido '$' já está sendo utilizado. Escolha outro!</h3>";
                }else{
                    $mensagem = "<h3>Ocorreu um erro ao inserir os dados: </h3> <h3>".mysqli_error($bd)."</h3> <h4>".mysqli_errno($bd)."</h4>";
                }
            }else{
                header("location: /TCC/visualization/turmas/lista/front_list.php?error=3");
            }

            echo "$mensagem";
        }
    }
?>