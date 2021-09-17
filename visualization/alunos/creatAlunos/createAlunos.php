<?php include_once("../../../settings/connections/check_session.php");?>
<?php include_once("../../../settings/functions.php")?>
<?php include_once("../../../settings/connections/connect.php")?>
<?php //include_once("../settings/push/pushDatas.php")?>

<!DOCTYPE html>

    <?php 
        $disabled = "";
        $id_turma = "";
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
        $nomeTurma = "";
        $obsView = "hidden";
        $obsText = "";
        $do = "Adicionar aluno";
        $select_value = "";
        $editar = "";
            $addImg = "<div>
            <label>Foto do aluno</label>
                <input type='file' name='foto' src='<?php echo $file?>' value='<?php echo $file?>' required/>
            </div>";

        if(isset($_POST["nome"])){
            $nome_turma = $_POST["nome"];
            $id = $_POST["id"];
            $tuu = "";
            $tu = "hidden";

        }else{
            $texto = "<h3>Mudar turma do aluno</h3>";
            $tuu = "hidden";
            $tu = "";
        }

        if(isset($_POST["acao"]) && $_POST["acao"] == "editar"){
            $id = $_POST["valor"];
            $id_turma = $_POST["id_turma"];

            $sql = "SELECT * FROM aluno WHERE id_aluno = $id";
            $resultado = mysqli_query($bd, $sql);
            $dados = mysqli_fetch_assoc($resultado);



            $nome = $dados["nome"];
            $sobrenome = $dados["sonbrenome"];
            $file = $dados["foto"];
            $data = $dados["data_nascimento"];
            $pai = $dados["nome_pai"];
            $mae = $dados["nome_mãe"];
            $do = "Salvar";
            $sql2 = "SELECT turma.nome_turma from turma, aluno where aluno.id_turma = turma.id_turma && aluno.id_turma = $id_turma";
            $result2 = mysqli_query($bd, $sql2);
            $dados2 = mysqli_fetch_assoc($result2);
            $nomeTurma = $dados2["nome_turma"];

            $obsView = "";
            $obsText = "Observações";
            $Contato = "";

            $addImg = "";

        }

        if(isset($_POST["novoAluno"]) && $_POST["novoAluno"] == "Adicionar novo aluno"){
            $id_turma = $_POST["id"];
            $sql2 = "SELECT * FROM turma where id_turma = $id_turma";
            $result2 = mysqli_query($bd, $sql2);
            $dados2 = mysqli_fetch_assoc($result2);
            $nomeTurma = $dados2["nome_turma"];
            $editar = "true";
        }

        $sqlP = "SELECT * FROM turma";
        $select_valueP = montaSelectBD($bd, $sqlP, false, $nomeTurma);

        $value = array('Email', 'Telefone', 'Instagram', 'Facebook', "Telefone Fixo");
        $description = array('Email', 'Telefone', 'Instagram', 'Facebook', 'Telefone Fixo');
        $select_value = makeSelect($value, $description, false, "");

    ?>

    <head>
        <meta charset="utf-8" />
        <title>Cadastro de aluno</title>
        <link rel="stylesheet" href="/TCC/CSS/cssForm/cssForm.css">
    </head>
    <body>

        <article>

            <?php include_once("../../menuForm.php")?>

            <main class='main'>
                <!-- Formulário -->
                <form action="../../../settings/alunos/createAlunos/pushAlunos.php" enctype="multipart/form-data" id='form' method="POST">
                    <h3 class='txtTitulo'>Informações do Aluno</h3>

                    <div class="primeiro_nome info">
                        <label>Primeiro Nome</label>
                        <input type="text" name='nome' value="<?php echo $nome?>" required>
                    </div>
                    <div class='sobrenome info'>
                        <label>Segundo nome</label>
                        <input type="text" name='sobrenome' value="<?php echo $sobrenome?>" required>
                    </div>
                    <?php echo $addImg?>
                    <div class="data_nascimento info">  
                        <label>Data de nascimento</label>
                        <input type="date" name='data' value="<?php echo $data?>" required>
                    </div>
                    <div class="nomePai info">
                        <label>Nome do Pai</label>
                        <input type="text" name='nomePai' value="<?php echo $pai?>" required>
                    </div>
                    <div class="nomeMae info">
                        <label>Nome da Mãe</label>
                        <input type="text" name='nomeMae' value="<?php echo $mae?>" required>
                    </div>
                    <div class="obs info">
                        <label for="obs"><?php echo $obsText?></label>
                        <input type="text" name='obs' <?php echo $obsView?>>
                    </div>

                    <?php 
                        if($editar == "true"){
                            echo "<h3 class='txtTitulo'>Contatos</h3>
                            <div class='tipoContato info'>
                                <label for='tipoContato'>Tipo de contato</label>
                                <select name='tipoContato' id='tipo' required>
                                    $select_value
                                </select>
                            </div>
                            <div class='Vcontato info'>
                                <label for='Vcontato info'>Contato</label>
                                <input type='text' name='Vcontato' required>
                            </div>";
                        }

                    ?>

                    <?php echo $texto?>
                    <div class="nomeTurma info">
                        <label>Nome da turma</label>
                        <select name="" id="" disabled required <?php echo $tuu?>>
                            <?php echo $select_valueP?>
                        </select>
                        <select name="nomeTurma " id="tipo" required <?php echo $tu?>>
                            <?php echo $select_valueP?>
                        </select>
                    </div>

                    <input type="hidden" value="<?php echo $id?>" name="id">
                    <input type="submit" value="<?php echo $do?>" name="acao" id='submitButton'>

                </form>
            </main>
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