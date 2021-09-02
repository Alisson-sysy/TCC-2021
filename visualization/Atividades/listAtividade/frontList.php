<?php

    $pathlist = dirname(__FILE__) . "./../../../settings/atividade/list/backList.php";
    include_once($pathlist);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lista de Atividades</title>
    </head>
    <body>

        <?php
            $pathMenu = dirname(__FILE__) . "./../../menu.php";
            include_once($pathMenu);
            
            if(count($atividades)>0){
                for($x=0; $x<count($atividades); $x++){
                    echo $atividades[$x];
                }
            }else{
                echo "Não há atividade nessa turma!";
            }

            // print_r($atividades);

            if($_SESSION['tipo'] == 'P'){
                 echo "<form action='/TCC/visualization/Atividades/criarAtividade/createAtividade.php' method='POST'>
                            <input type='hidden' name='idTurma' value='$idTurma'>
                            <input type='submit' value='Atividades'>
                    </form>";
            }
         ?>
    </body>
</html>