<?php 

    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_SESSION["login"]) == false){
        header("location: index.php?error=2");
    };

?>