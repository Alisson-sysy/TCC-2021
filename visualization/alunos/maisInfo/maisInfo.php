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
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/TCC/CSS/maisInfo/maisInfo.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Londrina+Sketch&family=Poppins:wght@100&display=swap" rel="stylesheet">
        <title>Informações Aluno</title>
    </head>
    <body>

        <?php include_once("../../men.php")?>


        <div class="infoAluno">
            <div id='firstInfo'>
                <form action="/TCC/settings/alunos/createAlunos/pushAlunos.php" enctype="multipart/form-data" method="POST">
                    <label for="mudarFoto"><div id='mask'><div class='texto'>Trocar imagem</div><img type='image' src='<?php echo $foto?>' width='300px' height='200px'></div></label>
                    <input type="hidden" name="alterImg">
                    <input type="hidden" name="idturma" value="<?php echo $turma?>">
                    <input type="hidden" name="id_aluno" value="<?php echo $id_aluno?>">
                    <input type="file" name="foto" id="mudarFoto" onchange="form.submit()" hidden>
                </form>
                <h5 id="nome"><?php  echo "<p class='textoFirstInfo'>". $nome.  " " .$sobrenome ."</p>"?></h5>
            </div>
            <h1 id='tituloInfoAluno'>Informações do aluno</h1>
            <p>Nome do Pai: <?php echo $pai?></p>
            <p>nome da Mãe: <?php echo $mae?></p>
            <p>Data de Nascimento: <?php echo $data?></p>


            <p><span>Turma:</span> <?php echo $nomeTurma?></p>
            <p><span>Professor:</span><?php echo $nomeProfessor ?></p>

            <p>Contatos:</p>
            <?php 
            
                $sql3 = "SELECT * FROM contato_aluno WHERE id_aluno = $id_aluno";
                $resultado3 = mysqli_query($bd, $sql3);
                if($_SESSION["tipo"] == "D"){
                    $novoCtt = "<form action='../../../settings/alunos/maisInfoBack/newCtt.php' method='POST'>
                        <input type='hidden' name='new' value='$criarContato'>
                        <input type='hidden' name='returnId' value='$id_aluno'>
                        <input type='submit' id='createContato' value='$criarContatoText'>
                    </form>";

                }else{
                    $ex = "";
                    $novoCtt = "";
                }
                while($dados3 = mysqli_fetch_assoc($resultado3)){
                    $Tcontato = $dados3["tipo_contato"];
                    $Vcontato = $dados3["contato"]; 

                    if(!isset($_SESSION)){
                        session_start();
                    }

                    if($_SESSION["tipo"] == "D"){
                        $ex = "<form method='POST'>
                            <input type='submit' name='excluir' id='deleteContato' value='✗'/>
                        </form>";
                    }
    

                    echo '<div id="contato">'.$Tcontato.": ". $Vcontato.    '</div>';
                }
                // echo $novoCtt;
            ?>


                <div class="obsAluno">
                    <h1 id='tituloInfoAluno'>Observações do aluno</h1>
                    <?php echo $div?>   
                    <?php 

                        if($_SESSION["tipo"] == "P"){
                            $idUsuario = $_SESSION["id"];
                            echo "<form action='../obsAluno/createObs.php' method='POST'>


                            <input type='hidden' name='idAluno' value='$id_aluno'>
                            <input type='hidden' name='idProfessor' value='$idUsuario'>
                            <input type='submit' id='addObsBtn' value='Adicionar Observação' >
                
                        </form>";
                        }
                    
                    ?>
                </div>

                <div class="obs">
                    <h1>Atividade do aluno</h1>
                    <p><?php echo $divAtv?></p>
                </div>

        </div>

    </body>
</html>