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
    
        <form action='/TCC/settings/planoMensal/createPlano/pushPlano.php' method='POST'>
        <div>
            <label for='nomePlano'>Título do Plano</label>
            <input type='text' name='nomePlano' value='$nome' required>
        </div>

        <div>
            <label for='dataPlano'>Data do Plano</label>
            <input type='date' name='dataPlano' value='$data' required>
        </div>
            <input type='hidden' name='id' value='$id_plano'><br>
            <input type='hidden' name='newPlano' value='$do'><br>
            <input type='submit' value='$do'>
        </form>

    ";

    if(isset($_POST["AdicionarTópico"])){
        $do = "AdicionarTpp";
        $id = $_POST["valor"];

        $form = "
            <form action='/TCC/settings/planoMensal/createPlano/pushPlano.php' method='POST'>
            <div>
                <label for='titTop'>Título do Tópico</label>
                <input type='text' name='titTop' value='$titTop' required>
            </div>

            <div>
                <label for='Ctt'>Conteúdo do Tópico</label>
                <input type='text' name='Ctt' value='$Ctt' required>
            </div>

                <input type='hidden' name='idPlano' value='$id'><br>
                <input type='hidden' name='newTop' value='$do'><br>
                <input type='submit' value='Adicionar Tópico'>
            </form>
        ";
    }

?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8"/>
        <title>Plano mensal</title>
    </head>
    <body>
        <?php include_once("../../menu.php");?>
        <div>
            <?php echo $form;?>
        </div>
    </body>
<html>