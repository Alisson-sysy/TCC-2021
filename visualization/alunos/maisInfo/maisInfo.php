<?php
        if(!isset($_SESSION)){
            session_start();
        }

        include_once("../../../settings/alunos/maisInfoBack/maisInfoBack.php");
        include_once("../../../settings/connections/connect.php");

        if(isset($_POST["new"]) || isset($_POST["ctt"])){
            if($_SESSION["tipo"] == "D"){
                if($_POST["new"] === "newCtt"){
                    $path = dirname(__FILE__) . '../../../../settings/functions.php';
                    include($path);
    
                    $idAluno = $_POST["returnId"];
    
                    $value = array('Email', 'Telefone', 'Instagram', 'Facebook', "Telefone Fixo");
                    $description = array('Email', 'Telefone', 'Instagram', 'Facebook', 'Telefone Fixo');
                    $select_valueC = makeSelect($value, $description, false, "");
                
                    $newLembrete = "
                        <div class='tipoContato'>
                        <label for='tipoContato'>Tipo de contato</label>
                        <select name='tipoContato' id='tipo' required>
                            $select_valueC
                        </select>
                        <div class='Vcontato'>
                            <label for='Vcontato'>Contato</label>
                            <input type='text' name='Vcontato' required>
                        </div>
                        </div>";

                    $criarContato = 'addContato';
                    $criarContatoText = 'Adicionar novo contato';
                    if(!isset($_GET['ctt'])){
                        header('location: /TCC/visualization/alunos/maisInfo/maisInfo.php?id='.$idAluno.'&&ctt');
                    }
                }    
            }
            if($_POST["new"] == 'addContato'){
                $tipoCtt = $_POST['tipoContato'];
                $vCtt = $_POST['Vcontato'];
                $idAluno = $_POST["returnId"];

                $sqlInsert = "
                    INSERT INTO contato_aluno VALUES ($idAluno, '$tipoCtt', '$vCtt');
                ";

                mysqli_query($bd, $sqlInsert) or die(mysqli_error());
            }
        }

        // if(isset($_POST['excluir'])){

        //     $sqlDelete = "
        //     Delete
        // ";

        // mysqli_query($bd, $sqlInsert) or die(mysqli_error());
        // }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Informações Aluno</title>
    </head>
    <body>

        <?php include_once("../../menu.php")?>
        
        <h5 id="nome">Nome: <?php echo $nome. " " .$sobrenome?></h5>
        <form action="/TCC/settings/alunos/createAlunos/pushAlunos.php" enctype="multipart/form-data" method="POST">
            <label for="mudarFoto"><img type='image' src='<?php echo $foto?>' width='300px' height='200px'></label>
            <input type="hidden" name="alterImg">
            <input type="hidden" name="idturma" value="<?php echo $turma?>">
            <input type="hidden" name="id_aluno" value="<?php echo $id_aluno?>">
            <input type="file" name="foto" id="mudarFoto" onchange="form.submit()" hidden>
        </form>

        <div class="infoAluno">
            <h1>Informações do aluno</h1>
            <h5>Data de Nascimento: <?php echo $data?></h5>
            <h5>Contatos:</h5>
            <p><?php ?></p>
            <?php 
            
                $sql3 = "SELECT * FROM contato_aluno WHERE id_aluno = $id_aluno";
                $resultado3 = mysqli_query($bd, $sql3);
                while($dados3 = mysqli_fetch_assoc($resultado3)){
                    $Tcontato = $dados3["tipo_contato"];
                    $Vcontato = $dados3["contato"]; 

                    $ex = "<form method='POST'>
                        <input type='submit' name='excluir' value='✗'/>
                    </form>";

                    echo '<p>'.$Tcontato.": ". $Vcontato.$ex.'</p>';
                }
            ?>
            <form action="" method="POST">
                <?php echo $newLembrete?>
                <input type="hidden" name="new" value="<?php echo $criarContato?>">
                <input type="hidden" name="returnId" value="<?php echo $id_aluno?>">
                <input type="submit" value="<?php echo $criarContatoText?>">
            </form>

            <h5>Turma: <?php echo $nomeTurma?></h5>
            <h5>Professor: <?php echo $nomeProfessor ?></h5>
        </div>

        <div class="obsAluno">
            <hr>
            <h1>Observações do aluno</h1>
            <h5><?php echo $obs?></h5>
        </div>
    </body>
</html>