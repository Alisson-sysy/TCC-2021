<?php 

    include_once("./connect.php");
    $login = mysqli_real_escape_string($bd, $_POST["login"]);
    $password = mysqli_real_escape_string($bd, $_POST["password"]);

    $sql_cod = "select * from usuario where
            login = '$login' and
            password = '$password'";

    $resultado = mysqli_query($bd, $sql_cod) or die(mysqli_error($bd));

    if(mysqli_num_rows($resultado) == 1){
        session_start();

        $dados = mysqli_fetch_assoc($resultado);

        $_SESSION["login"] = $login;
        $_SESSION["nome"] = $dados["Nome"];
        $_SESSION["tipo"] = $dados["Tipo_usuario"];
        $_SESSION["id"] = $dados["ID_usuario"];
        $_SESSION["logado"] = $dados["logado"];
        

        mysqli_close($bd);

        if($_SESSION["logado"] == "N"){
            header("location: ../../visualization/Troca_senha.php");
        }else{
            header("location: ../../visualization/home.php");
        }
    }else{
        mysqli_close($bd);
        header("location: ../../index.php?error=1");
    }

?>