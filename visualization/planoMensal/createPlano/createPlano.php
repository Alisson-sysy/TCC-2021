<?php 
    include_once("../../../settings/connections/connect.php");

    $do = "addPlano";
    $nome = "";
    $Ctt = "";
    $titTop = "";
    $data = "";
    $id_plano = "";
    if(isset($_POST["editar"])){
        $id = $_POST["valor"];

        $sql = "SELECT * from plano_mensal where id_plano = $id";
        $resultado = mysqli_query($bd, $sql) or die(mysqli_error($bd));

        $dados = mysqli_fetch_assoc($resultado);

        $id_plano = $dados["id_plano"];
        $nome = $dados["tt_plano"];
        $data = $dados["data"];

        $do = "Editar";

    }

    $form = "
    
    <form action='/TCC/settings/planoMensal/createPlano/pushPlano.php' id='form' method='POST'>
    <div class='info'>
        <label for='nomePlano'>Título do Plano</label>
        <input type='text' name='nomePlano' value='$nome' required>
    </div>

    <div class='info'>
        <label for='dataPlano'>Data do Plano</label>
        <input type='date' name='dataPlano' value='$data' required>
    </div>
        <input type='hidden' name='id' value='$id_plano'><br>
        <input type='hidden' name='newPlano' value='$do'><br>
        <input type='hidden' id='submitButton' value='$do'>
        <input type='submit' name='editTopic' value='Editar' id='submitButton' >
    </form>

    ";

    if(isset($_POST["editarTopico"])){
        $idTopic = $_POST['idTopic'];

        $sql = "SELECT * from topico_plano where id_topico = $idTopic";
        $resultado = mysqli_query($bd, $sql) or die(mysqli_error($bd));

        $dados = mysqli_fetch_assoc($resultado);

        $titTop = $dados['topico'];
        $Ctt = $dados['ctt_topico'];


        $form = "
            <form action='/TCC/settings/planoMensal/createPlano/pushPlano.php' id='form' method='POST'>
            <div class='info'>
                <label for='titTop'>Título do Tópico</label>
                <input type='text' name='titTop' value='$titTop' required>
            </div>

            <div class='info'>
                <label for='Ctt'>Conteúdo do Tópico</label>
                <input type='text' name='Ctt' value='$Ctt' required>
            </div>

                <input type='hidden' name='idTopic' value='$idTopic'><br>
                <input type='submit' id='submitButton' name='submitButton'  value='Editar'>
            </form>
        ";
    }

    if(isset($_POST["AdicionarTópico"])){
        $do = "AdicionarTpp";
        $id = $_POST["valor"];

        $form = "
            <form action='/TCC/settings/planoMensal/createPlano/pushPlano.php' id='form' method='POST'>
            <div class='info'>
                <label for='titTop'>Título do Tópico</label>
                <input type='text' name='titTop' value='$titTop' required>
            </div>

            <div class='info'>
                <label for='Ctt'>Conteúdo do Tópico</label>
                <input type='text' name='Ctt' value='$Ctt' required>
            </div>

                <input type='hidden' name='idPlano' value='$id'><br>
                <input type='hidden' name='newTop' value='$do'><br>
                <input type='submit' id='submitButton'  value='Adicionar Tópico'>
            </form>
        ";
    }

?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="/TCC/CSS/cssForm/cssform.css">
        <title>Plano mensal</title>
    </head>
    <body>
        <?php include_once("../../menuForm.php");?>
        <main class='main'>
            <?php echo $form;?>
        </main>
    </body>
<html>