<?php

    $path = "../../../settings/alunos/maisInfoBack/fotos/";
    $diretorio = dir($path);

    echo "Lista de Arquivos do diretório '<strong>".$path."</strong>':<br />";
    while($arquivo = $diretorio -> read()){
        
    }

?>