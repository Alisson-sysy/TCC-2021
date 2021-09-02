<?php
    $connect = dirname(__FILE__) . '/../../connections/connect.php';
    include_once($connect);

    if(!isset($_SESSION)){
        session_start();
    }


    if(isset($_GET["id"])){
        $id_turma = $_GET["id"];

        $sqlIdAluno = "SELECT id_aluno from aluno where id_turma = $id_turma";
        $result =  mysqli_query($bd, $sqlIdAluno) or die(mysqli_error($bd));
        $dados0 = mysqli_fetch_assoc($result);

        while($dados0 = mysqli_fetch_assoc($result) ){
            $id_aluno = $dados["id_aluno"];
            $sql = "DELETE FROM contato_aluno WHERE id_aluno = $id_aluno";
        }
        //Pegar os Id dos alunos que participam da turma que vai se apagada

        $sql = "SELECT id_aluno from aluno where id_turma = $id_turma";
        $resultado = mysqli_query($bd, $sql) or die(mysqli_error($bd));
        

       for($x=0;$x<2;$x++){
           //Para uma turma ser apagada, é necessário que todas as informações que dependem dela sejam apagadas tbm

           //Apagar contatos de todos os alunos que pertencem a essa turma
           while($dados = mysqli_fetch_assoc($resultado)){
                $id_aluno = $dados["id_aluno"];
                $sqlDeleteContato = "DELETE FROM contato_aluno WHERE id_aluno = $id_aluno";
                mysqli_query($bd, $sqlDeleteContato) or die(mysqli_error($bd));
           } 
           
           $sqlA = "DELETE FROM aluno WHERE id_turma = $id_turma";
           $sql = "DELETE FROM usuario_turma WHERE id_turma = $id_turma";
           $sqli = "DELETE FROM turma WHERE id_turma = $id_turma";

           mysqli_query($bd, $sqlA) or die(mysqli_error($bd));
           mysqli_query($bd, $sql) or die(mysqli_error($bd));
           mysqli_query($bd, $sqli) or die(mysqli_error($bd));
       }

        header("location:/TCC/visualization/turmas/lista/front_list.php");
   }

    $id_usuario = $_SESSION["id"];
    $tipo_usuario = $_SESSION["tipo"];
    $mod = "";

    if($tipo_usuario == "D"){
        $mod = "<th>Excluir</th><th>Editar</th>";
    }
    
    if ($_SESSION["tipo"] == "D"){
        $sql = "SELECT turma.* FROM turma";
    }else{
        $sql = "SELECT turma.* from turma, usuario_turma, usuario where turma.id_turma = usuario_turma.id_turma && usuario.ID_usuario = usuario_turma.ID_usuario && usuario.ID_usuario = $id_usuario;";
    }
    $resultado = mysqli_query($bd, $sql);

    if(mysqli_num_rows($resultado) > 0){

        $table = "<table class='tabela-list' id='tabela-list' border=1>";
        $table = $table."<tr><th>Turma</th><th>Periodo</th><th>aluno</th><th>Atividades</th>$mod</tr>";

        while($dados = mysqli_fetch_assoc($resultado)){
            $id = $dados["id_turma"];
            $nome_turma = $dados["nome_turma"];
            $periodo_aula = $dados["periodo"];

            $excluir = "<input type='button' name='acao' value='excluir' onclick='confirma($id)'>";
            
            $editar = "<form action='/TCC/visualization/turmas/create/index.php' method='POST'>
                            <input type='hidden' name='valor' value='$id'>
                            <input type='submit' name='acao' value='editar'>
                        </form>";

            $alunos = "<form action='/TCC/settings/alunos/lista/back_list.php?id=$id' method='POST'>
                        <input type='hidden' name='valor' value='$id'>
                        <input type='submit' name='aluno' value='Alunos'>
                    </form>";
            
            $atividades = "<form action='/TCC/visualization/Atividades/listAtividade/frontList.php' method='POST'>
                    <input type='hidden' name='idTurma' value='$id'>
                    <input type='submit' value='Atividades'>
                </form>";

                    
            if($tipo_usuario == "D"){
                $table = $table."<tr><td>$nome_turma</td><td>$periodo_aula</td><td>$alunos</td><td>$atividades</td><td>$excluir</td><td>$editar</td></tr>";
            }else if($tipo_usuario == "P"){
                $table = $table."<tr><td>$nome_turma</td><td>$periodo_aula</td><td>$alunos</td><td>$atividades</td></tr>";
            }

        }
        $table = $table."</table>";
    }else{
        $table = "Não há registros";
    }
?>

<script>
    function confirma(caminho){  
        alert("Apagar uma turma? Tem certeza sobre isso?");
        confirm = confirm('Se você apagar esse turma, todos os alunos, que estão ligados a ela, serão apagados também. Permanentemente!!!');
        if(confirm){
            window.location.href = "/TCC/settings/turma/lista/back_listTurma.php?id="+caminho;
        }else{
            window.location.href = "/TCC/visualization/alunos/lista/front_list.php";
        }   
    }
</script>