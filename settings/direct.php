<?php 
    session_start();
    
    if(isset($_SESSION["login"]) != false){
        if($_SESSION["logado"] == "N"){
            header("location: visualization/Troca_senha.php");
        }else{
            header("location: visualization/home.php");
        }
    }

?>