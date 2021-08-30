<?php

    include_once("../../../settings/connections/connect.php");

    if(!isset($_SESSION)){
        session_start();
    }

   
    if(isset($_POST["newPlano"])){
        $id_usuario = $_SESSION["id"];
        $id_plano = $_POST["id"] != "" ? mysqli_real_escape_string($bd, $_POST["id"]): header("location: /TCC/visualization/planoMensal/createPlano/createPlano.php?error=12");     
        $data = $_POST["dataPlano"] != "" ? mysqli_real_escape_string($bd, $_POST["dataPlano"]): header("location: /TCC/visualization/planoMensal/createPlano/createPlano.php?error=13"); 
        $tt_plano = $_POST["nomePlano"] != "" ? mysqli_real_escape_string($bd, $_POST["nomePlano"]): header("location: /TCC/visualization/planoMensal/createPlano/createPlano.php?error=14");

        if($_POST["newPlano"] === "addPlano"){
    
            $sql = "INSERT into plano_mensal (tt_plano, id_usuario, data) values ('$tt_plano', $id_usuario, '$data')";
            if(!mysqli_query($bd, $sql)){
                if ( mysqli_errno($bd) == 1062 ) {
                    $mensagem = "<h3>Prezado usuário o valor escolhido '$' já está sendo utilizado. Escolha outro!</h3>";
                } else {
                    $mensagem = "<h3>Ocorreu um erro ao inserir os dados: </h3> <h3>".mysqli_error($bd)."</h3> <h4>".mysqli_errno($bd)."</h4>";
                }
            }else{
                header("location: /TCC/visualization/planoMensal/list/planoLista.php");
            }
    
        } else if($_POST["newPlano"] === "Editar"){
    
            $sql = "UPDATE plano_mensal SET
                    tt_plano = '$tt_plano',
                    data = '$data'
                where
                    id_plano = $id_plano";
            mysqli_query($bd, $sql) or die(mysqli_error($bd));
            header("location: /TCC/visualization/planoMensal/list/planoLista.php");
    
        }
    }
    
    if($_POST["newTop"]){

        $tituloTop = $_POST["titTop"] != "" ? mysqli_real_escape_string($bd, $_POST["titTop"]): header("location: /TCC/visualization/planoMensal/createPlano/createPlano.php?error=12");    
        $CttTop = $_POST["Ctt"] != "" ? mysqli_real_escape_string($bd, $_POST["Ctt"]): header("location: /TCC/visualization/planoMensal/createPlano/createPlano.php?error=13");    
        $idPlano = $_POST["idPlano"];

        $sql = "INSERT into topico_plano (id_plano, topico, ctt_topico) values ($idPlano, '$tituloTop', '$CttTop')";

        if(!mysqli_query($bd, $sql)){
            if ( mysqli_errno($bd) == 1062 ) {
                $mensagem = "<h3>Prezado usuário o valor escolhido '$' já está sendo utilizado. Escolha outro!</h3>";
            } else {
                $mensagem = "<h3>Ocorreu um erro ao inserir os dados: </h3> <h3>".mysqli_error($bd)."</h3> <h4>".mysqli_errno($bd)."</h4>";
            }
        }else{
            header("location: /TCC/visualization/planoMensal/list/planoLista.php");
        }

        echo $mensagem;
    }
    
?>
