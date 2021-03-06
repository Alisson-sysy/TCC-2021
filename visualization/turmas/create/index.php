<?php include_once("../../../settings/connections/check_session.php");?>
<?php include_once("../../../settings/functions.php")?>
<?php include_once("../../../settings/connections/connect.php")?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8"/>
        <title>Cadastro de Turmas</title>
        <link rel="stylesheet" href="/TCC/CSS/cssForm/cssform.css">
    </head>
    <body>
        <?php

            $nome = " ";
            $periodo = "";
            $do = "Criar Turma";
            $id = '';
            if(isset($_POST["acao"]) && $_POST["acao"] === "editar"){
                        
                $id = $_POST["valor"];
                $sql = "SELECT * FROM turma WHERE id_turma = $id";
                $result = mysqli_query($bd, $sql);
                $dados = mysqli_fetch_assoc($result);

                $nome = $dados["nome_turma"];
                $periodo = $dados["periodo"];
                $do = "Salvar";
            }

            $mensagem = "";
            $value = array('M', 'T');
            $description = array('Manhã', 'Tarde');
            $select_value = makeSelect($value, $description, false, $periodo);

            if(isset($_GET["error"])){
                if($_GET["error"] == 0){
                    $mensagem = "Cadastrado com sucesso";
                }else if($_GET["error"] == 1){
                    $mensagem = "Preencha todos os dados";
                }
            }
        ?>
        <?php include_once("../../menuForm.php")?>
        <main class='main'>
            <form action="/TCC/settings/turma/create/push_turmas.php" id='form' method="POST"> 
                    <div class='info'>
                        <label>Nome da turma:</label>
                        <input type="text" name='turmaNome' value="<?php echo $nome?>" required>
                    </div>
                    <div class="Periodo info">
                        <label>Periodo</label>
                        <select name="periodo" id="Periodo" required>
                            <?php echo $select_value?>
                        </select>
                    </div>
                <input type="hidden" value="<?php echo $id?>" name="id">
                <input type="submit" value="<?php echo $do?>" id='submitButton' name="acao">
                <p><?php echo $mensagem?></p>
            </form>
        </main>
    </body>

<html>