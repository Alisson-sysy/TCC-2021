<?php 

    if(!isset($_SESSION)){
        session_start();
    }

    include_once("../../function.php");

    if(isset($_POST["new"]) || isset($_GET['ctt'])){
        if($_SESSION["tipo"] == "D"){
            if($_POST["new"] === "newCtt"){
                $path = dirname(__FILE__) . '../../../../settings/functions.php';
                include($path);

                $idAluno = $_POST["returnId"];

                $value = array('Email', 'Telefone', 'Instagram', 'Facebook', "Telefone Fixo");
                $description = array('Email', 'Telefone', 'Instagram', 'Facebook', 'Telefone Fixo');
                $select_valueC = makeSelect($value, $description, false, "");
            
                $newLembrete = "<form>
                    <div class='tipoContato'>
                    <label for='tipoContato'>Tipo de contato</label>
                    <select name='tipoContato' id='tipo' required>
                        $select_valueC
                    </select>
                    </div>

                </form>";

                header("location: /TCC/visualization/alunos/maisInfo/maisInfo.php?id=$idAluno&&ctt=nw");
            }    
        }
    }

?>