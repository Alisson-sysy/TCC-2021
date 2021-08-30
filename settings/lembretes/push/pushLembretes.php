<?php 
    include_once('../../connections/connect.php');
    if(isset($_POST["add"])){
        $newLembrete = "";
        if($_POST["add"] === "Adicionar lembrete"){

            session_start();
            $id_usuario = $_SESSION["id"];
            $texto = $_POST["lembreteText"] != ""? mysqli_real_escape_string($bd, $_POST["lembreteText"]): header("location: /TCC/visualization/teacherRegister.php?error=1");

            $sql = "INSERT into lembrete (id_usuario, texto) values ($id_usuario, '$texto')";

            mysqli_query($bd, $sql) or die(mysqli_error($bd));

            header("location: /TCC/visualization/home.php");
        }
    }

    
