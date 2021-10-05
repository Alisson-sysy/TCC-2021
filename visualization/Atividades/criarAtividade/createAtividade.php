<?php
    $path = dirname(__FILE__) . '../../../../settings/functions.php';
    include_once($path);

    if(isset($_POST['idTurma'])){
        $idTurma = $_POST['idTurma'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/TCC/CSS/cssForm/cssform.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Archivo+Narrow&display=swap" rel="stylesheet">
        <title>Atividades</title>
    </head>
    <body>
        <?php include_once("../../menuForm.php")?>
        <main class='main'>
            <form action="/TCC/settings/Atividade/pushAtividade/pushAtividade.php" id='form' method="post">
                <div class='info'>
                    <label for="nomeAtividade">Nome da Atividade</label>
                    <input type="text" name="nomeAtividade" id="nomeAtividade" required>
                </div>
                <div class="info">
                    <label for="diaEntrega" class="diaEntrega">Dia de entrega</label>
                    <input type="date" name="diaEntrega" id="diaEntrega" required>
                </div>
                <div class="info">
                    <label for="horaEntrega" class="horaEntrega">Hora da entrega</label>
                    <input type="time" name="horaEntrega" id="horaEntrega" required>
                </div> 
                <div class="info">
                    <label for="descAtv" class="descAtv">Descrição da atividade</label>
                    <input type="text" name="descAtv" id="descAtv" required>
                </div> 

                <input type="hidden" name="idTurma" value="<?php echo $idTurma?>">
                <input type="hidden" name="atv" value="addAtv">
                <input type="submit" id='submitButton' value="Adicionar Atividade">
            </form>
        </main>
        <?php
        
            if(isset($_GET['error'])){
                if($_GET['error'] == 1){
                    echo "Preencha todos os dados";
                }
            }

        ?>
    </body>
</html>