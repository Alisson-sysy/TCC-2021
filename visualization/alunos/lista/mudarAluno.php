<?php include_once("../../../settings/connections/check_session.php");?>
<?php include_once("../../../settings/functions.php")?>
<?php include_once("../../../settings/connections/connect.php")?>
<?php //include_once("../settings/push/pushDatas.php")?>

<!DOCTYPE html>

    <?php 
        $disabled = "";
        $nome_turma = "";
        $texto = "";
        $tuu = "hidden";
        $tu = "";
        $nome = "";
        $sobrenome = "";
        $file = "";
        $data = "";
        $pai = "";
        $mae = "";
        $do = "Mudar a turma";

        if(isset($_POST["mudar"]) && $_POST["mudar"] == "Mudar todos os alunos" && isset($_POST["turma"])){
            $id_turma = $_POST["turma"];

            // $sql = "SELECT * FROM aluno WHERE id_aluno = $id";
            // $resultado = mysqli_query($bd, $sql);
            // $dados = mysqli_fetch_assoc($resultado);



            // $nome = $dados["nome"];
            // $sobrenome = $dados["sonbrenome"];
            // $file = $dados["foto"];
            // $data = $dados["data_nascimento"];
            // $pai = $dados["nome_pai"];
            // $mae = $dados["nome_mãe"];
            // $do = "Salvar";

            $sql2 = "SELECT nome_turma from turma where id_turma = $id_turma";
            $result2 = mysqli_query($bd, $sql2);
            $dados2 = mysqli_fetch_assoc($result2);
        }

        $nomeTurma = $dados2["nome_turma"];
        $sqlP = "SELECT * FROM turma";
        $select_valueP = montaSelectBD($bd, $sqlP, false, $nomeTurma);

    ?>

    <head>
        <meta charset="utf-8" />
        <title>Cadastro de aluno</title>
    </head>
    <body>

        <article>

            <?php include_once("../../menu.php")?>
            <h3>Mudar todos os alunos de turma</h3>
            <!-- Formulário -->
            <form action="/TCC/settings/alunos/createAlunos/pushAlunos.php" method="POST">

                <div class="nomeTurma">
                    <select name="novaTurma" id="tipo" required <?php echo $tu?>>
                        <?php echo $select_valueP?>
                    </select>
                </div>

                <input type="hidden" value="<?php echo $id_turma?>" name="idTurma">
                <input type="submit" value="<?php echo $do?>" name="mudar">
            </form>
            <?php 
            //  Vai buscar qualquer tipo de informação que vem pela Url 
                if(isset($_GET["error"]) && $_GET["error"] === "1"){
                    echo "Preencha todos os dados!";
                }else if(isset($_GET["error"]) && $_GET["error"] === "0"){
                    echo "Dados cadastrados com sucesso!!";
                }
            ?>
        </article>
    </body>

<html>