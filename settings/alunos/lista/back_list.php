<?php
    $connect = dirname(__FILE__) . '/../../connections/connect.php';
    include_once($connect);

    if(!isset($_SESSION)){
        session_start();
    }

    $resultado = "";
    $button = "";

   if(isset($_POST["aluno"]) && $_POST["aluno"] === "Alunos"){
        $idT = $_POST["valor"];
   }else{
       $idT = $_GET["id"]; 
   }

   if(isset($_GET["id2"])){
        $id = $_GET["id2"];

        $sql2 = "DELETE FROM contato_aluno WHERE id_aluno = $id";
        $sql = "DELETE FROM aluno WHERE id_aluno = $id";

        mysqli_query($bd, $sql2) or die(mysqli_error($bd));
        mysqli_query($bd, $sql) or die(mysqli_error($bd));
    }

    $sql = "SELECT aluno.* FROM aluno where id_turma = $idT";
    $resultado = mysqli_query($bd, $sql);

    if(mysqli_num_rows($resultado) > 0){

        $table = "";
        

        while($dados = mysqli_fetch_assoc($resultado)){
            $id = $dados["id_aluno"];
            $id_turma = $dados["id_turma"];
            $nome = $dados["nome"];
            $sobrenome = $dados["sonbrenome"];
            $data = $dados["data_nascimento"];
            $pai = $dados["nome_pai"];
            $mae = $dados["nome_mãe"];

            $excluir = "<input type='button' name='acao' value='excluir' id='btn' onclick='confirma($id)'>";
            
            $editar = "<form action='/TCC/visualization/alunos/creatAlunos/createAlunos.php' method='POST'>
                            <input type='hidden' name='id_turma' value='$id_turma'>
                            <input type='hidden' name='valor' value='$id'>
                            <input type='submit' name='acao' id='btn' value='editar'>
                        </form>";
            $more = "<form action='/TCC/visualization/alunos/maisInfo/maisInfo.php' method='POST'>
                        <input type='hidden' name='id_turma' value='$id_turma'>
                        <input type='hidden' name='valor' value='$id'>
                        <input type='submit' name='acao' id='btn' value='Ver mais'>
                    </form>";

            $table = $table."<div id='classItem'><p class='PInfo'>$nome</p><p class='PInfo'>$sobrenome</p>$excluir $editar $more </div>";

        }
        $table = $table."</table>";
    }else{
        $table = "Não há alunos nessa turma";
    }

    $sql = "SELECT * FROM turma where id_turma = $idT";
    $resultado = mysqli_query($bd, $sql);
    $dados = mysqli_fetch_assoc($resultado);
    $nome_turma = $dados["nome_turma"];
    $id = $dados["id_turma"];

    if($_SESSION['tipo'] == 'D'){
        $button = "<div class='buttons2'>
        <div class='novoAluno'>
        <form action='/TCC/visualization/alunos/creatAlunos/createAlunos.php' method='POST'>
            <input type='submit' name='novoAluno' id='btn' value='Adicionar novo aluno'>
            <input type='hidden' name='id' value='$id'>
            <input type='hidden' name='nome' value='$nome_turma'>
        </form>
    </div>

    <div class='mudarAlunos'>
        <form action='/TCC/visualization/alunos/lista/mudarAluno.php' method='POST'>
            <input type='submit' name='mudar' id='btn' value='Mudar todos os alunos'>
            <input type='hidden' name='turma'  value='$id'>
        </form>
    </div>
    </div>"
    ;
    }

?>

<!DOCTYPE html>
    <head>
        <title>Alunos</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/TCC/CSS/lista/listaProfessores.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Archivo+Narrow&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php include_once("../../../visualization/men.php");?>
        
        <?php
            // echo $pesquisar;
        ?>

        <fieldset class="lista" id="lista">
            <?php   
                echo $table;
                echo $button;
            ?>
        </fieldset>

        <?php 
            $mensagem = "";

            if(isset($_GET["confi"]) && $_GET["confi"] === "1"){
                $mensagem = "Dados salvos com sucesso";
            }

            echo "<p>$mensagem</p>"

            
        ?>
    </body>
</html>

<script>
    function confirma(caminho){  
        alert("Apagar um Aluno? Tem certeza sobre isso?");
        confirm = confirm('Se você apagar esse aluno(a), todas as obervações e informações pessoais do mesmo serão apagadas, permanentemente!!!');
        if(confirm){
            window.location.href = "/TCC/settings/alunos/lista/back_list.php?id="+<?php echo $idT?>+"&&"+"id2="+caminho;
        }else{
            window.location.href = "/TCC/visualization/alunos/lista/front_list.php";
        }   
    }
</script>