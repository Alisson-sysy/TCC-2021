<?php 
                        //local, user, password, table
    $bd = mysqli_connect("localhost", "root", "", "profietcc");


    if($bd){
        mysqli_set_charset($bd, "utf8");
    }else{
        echo "Não foi possível manter conexão com o Banco de Dados <br>";
        echo "Erro de conexão:".mysqli_connect_error();
        exit();
    }

?> 