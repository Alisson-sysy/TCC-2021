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

        $table = "<table class='tabela-list' id='tabela-list' border=1>";


        while($dados = mysqli_fetch_assoc($resultado)){
            $texto = $dados["texto"];
            $id_lembrete = $dados["id_lembrete"];


            $excluir = "<center><form method='post'>
                        <input type='hidden' name='id' value='$id_lembrete'>
                        <input type='hidden' name='acao' value='EXCLUIR'>
                        <input type='submit' value='✓'>
                    </form></center>";

            $table = $table."<tr><td>$excluir</td><td>$texto</td></tr>";

        }
        $table = $table."</table>";
    }else{
        $table = "Não há lembretes";
    }


?>