<?php include_once("../../../settings/connections/check_session.php");?>
<?php include_once("../../../settings/functions.php")?>
<?php include_once("../../../settings/connections/connect.php")?>
<?php

    $idAluno = $_POST['idAluno'];
    $do = "criarObs";

?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8"/>
        <title>Cadastro de Turmas</title>
        <link rel="stylesheet" href="/TCC/CSS/cssForm/cssform.css">
    </head>
    <body>
        <?php include_once("../../menuForm.php")?>
        <main class='main'>
            <form action="/TCC/settings/alunos/obs/createobs.php" id='form' method="POST"> 
                    <div class='info'>
                        <label>Observação para o aluno:</label>
                        <textarea type="textarea" name="obsCtt" value='Amogus' placeholder="Observação do aluno" required></textarea>
                    </div>
                <input type="hidden" value="<?php echo $idAluno?>" name="idAluno">
                <input type="hidden" value="<?php echo $do?>" name="do">

                <input type="submit" value="Adicionar Observação" id='submitButton' name="acao">
            </form>
        </main>
    </body>

<html>