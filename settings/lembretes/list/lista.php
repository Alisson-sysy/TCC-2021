<?php

    $path3 = dirname(__FILE__) . '/../../connections/connect.php';

    include($path3);

    $id_usuario = $_SESSION["id"];

    if(isset($_POST["acao"])){
        if($_POST["acao"] == "EXCLUIR"){
            $id_lembrete = $_POST["id"];
            $sql = "DELETE FROM lembrete where id_lembrete = $id_lembrete";
            mysqli_query($bd, $sql) or die(mysqli_error($bd));
        }
    }

    $sql = "SELECT * FROM lembrete where id_usuario = $id_usuario";
    $resultado = mysqli_query($bd, $sql);

    if(mysqli_num_rows($resultado) > 0){

        $table = "<div class='lembrete' id='tabela-list' border=1>";


        while($dados = mysqli_fetch_assoc($resultado)){
            $textoTitu = $dados["texto"];
            $id_lembrete = $dados["id_lembrete"];
            $texto = $dados["textoTitu"];

            $table = $table."<div class='ctt ctt-drop'>";

            $excluir = "<form method='post'>
                        <input type='hidden' name='id' value='$id_lembrete'>
                        <input type='hidden' name='acao' value='EXCLUIR'>
                        <input type='submit' class='exc' value='✓'>
                    </form>";

            $table = $table."$excluir<p class='txtCtt'>$textoTitu <span>$texto<span></p>";
            $table = $table."</div>";
        }
        $table = $table."
            <form class='ctt ctt-button' method='POST' id='fomradd'>
                <input type='hidden' name='new' value='Novo Lembrete'>
                <input type='image' id='butAdd' class='addButton' src='/TCC/img/add-button.png' type='submit'>
            </form>
        </div>";
    }else{
        $table = "<p class='txtNtxt'>Não há lembretes
        
        <form class='ctt ctt-button ctt-buttonN' method='POST' id='fomradd'>
            <input type='hidden' name='new' value='Novo Lembrete'>
            <input type='image'  class='addButton' src='/TCC/img/add-button.png' id='butAdd' type='submit'>
        </form>

        </p>
            ";
    }


?>