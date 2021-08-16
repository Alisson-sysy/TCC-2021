<?php
    $connect = dirname(__FILE__) . '/../../connect.php';
    include_once($connect);


    if(isset($_POST["acao"]) && $_POST["acao"] === "excluir"){
        $id_turma = $_POST["valor"];
       for($x=0;$x<2;$x++){
           $sql = "DELETE FROM usuario_turma WHERE id_turma = $id_turma";
           $sqli = "DELETE FROM turma WHERE id_turma = $id_turma";
   
           mysqli_query($bd, $sqli);
           mysqli_query($bd, $sql);
       }

        header("location:/TCC/visualization/turmas/lista/front_list.php");
   }


    $sql = "SELECT turma.* FROM turma";
    $resultado = mysqli_query($bd, $sql);

    if(mysqli_num_rows($resultado) > 0){

        $table = "<table class='tabela-list' id='tabela-list' border=1>";
        $table = $table."<tr><th>Turma</th><th>Periodo</th><th>Excluir</th><th>Editar</th></tr>";

        while($dados = mysqli_fetch_assoc($resultado)){
            $id = $dados["id_turma"];
            $nome_turma = $dados["nome_turma"];
            $periodo_aula = $dados["periodo"];

            $excluir = "<form action='/TCC/settings/turma/lista/back_listTurma.php' method='POST'>
                            <input type='hidden' name='valor' value='$id'>
                            <input type='submit' name='acao' value='excluir'>
                        </form>";
            
            $editar = "<form action='/TCC/visualization/turmas/create/index.php' method='POST'>
                            <input type='hidden' name='valor' value='$id'>
                            <input type='submit' name='acao' value='editar'>
                        </form>";

            $table = $table."<tr><td>$nome_turma</td><td>$periodo_aula</td><td>$excluir</td><td>$editar</td></tr>";

        }
        $table = $table."</table>";
    }else{
        $table = "Não há registros";
    }
?>