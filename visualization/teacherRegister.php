<?php include_once("../settings/connections/check_session.php");?>
<?php include_once("../settings/functions.php")?>
<?php include_once("../settings/connections/connect.php")?>

<!DOCTYPE html>
 <head>
        <meta charset="utf-8" />
        <?php include_once("menuForm.php")?>
        <title>Cadastro Professor</title>
        <link rel="stylesheet" href="/TCC/CSS/cssForm/cssform.css">
        <!-- Fonte arquivo -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Archivo+Narrow&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Londrina+Sketch&family=Poppins:wght@100&display=swap" rel="stylesheet">
    </head>
    <body>

        <article>
            <!-- Vai gerar o select de opções -->
            <?php
                $nome_turma = "";
                $nome = "";
                $sobrenome = "";
                $data = "";
                $tipo = "";
                $id = "";
                $do = "Adicionar";

                if(isset($_POST["acao"]) && $_POST["acao"] === "Editar"){
                    
                    

                    $id = $_POST["valor"];
                    $sql = "SELECT * FROM usuario WHERE ID_usuario = $id";
                    $result = mysqli_query($bd, $sql);
                    $dados = mysqli_fetch_assoc($result);
            
                    $nome = $dados["Nome"];
                    $sobrenome = $dados["Sobrenome"];
                    $data = $dados["Data_nascimento"];
                    $tipo = $dados["Tipo_usuario"];
                    $id = $dados["ID_usuario"];
                    $do = "Salvar";
                    

                    $sql2 = "SELECT turma.nome_turma FROM turma, usuario_turma WHERE usuario_turma.ID_usuario = $id && usuario_turma.id_turma = turma.id_turma;";
                    $result2 = mysqli_query($bd, $sql2);
                    $dados2 = mysqli_fetch_assoc($result2);

                    if(is_array($dados2)){
                        $nome_turma = $dados2["nome_turma"];
                    }else{
                        $nome_turma = "Sem turma";
                    }
                }

                $value = array('D', 'P');
                $description = array('Diretor', 'Professor');
                $select_value = makeSelect($value, $description, false, $tipo);

                $sqlP = "SELECT * FROM turma ORDER BY nome_turma";
                $select_valueP = montaSelectBD($bd, $sqlP, false, $nome_turma);

                $value = array('Email', 'Telefone', 'Instagram', 'Facebook', "Telefone Fixo");
                $description = array('Email', 'Telefone', 'Instagram', 'Facebook', 'Telefone Fixo');
                $select_valueC = makeSelect($value, $description, false, "");

            ?>

            <main class='main'>
                <!-- Formulário -->
                <form action="../settings/push/pushDatas.php" method="POST" id='form'>
                    <h3 class='txtTitulo'>Dados do professor</h3>
                    <div class="primeiro_nome info">
                        <label>Primeiro Nome</label>
                        <input type="text" name='nome' value="<?php echo $nome?>" required>
                    </div>
                    <div class='sobrenome info'>
                        <label>Segundo nome</label>
                        <input type="text" name='sobrenome' value="<?php echo $sobrenome?>" required>
                    </div>
                    <div class="data_nascimento info">  
                        <label>Data de nascimento</label>
                        <input type="date" name='data' value="<?php echo $data?>" required>
                    </div>

                    <div class="tipo_usuario info">
                        <label>Tipo do usuário</label>
                        <select name="tipo" id="tipo" value="<?php echo $tipo?>" required>
                            <?php echo $select_value?>
                        </select>
                    </div>
                    
                    <div class="tipo_usuario info">
                        <label>Turma do professor</label>
                        <select name="turma" id="turma" required>
                            <?php echo $select_valueP?>
                        </select>
                    </div>

                    <h3 class='txtTitulo'>Contatos</h3>
                    <div class="tipoContato info">
                        <label for="tipoContato">Tipo de contato</label>
                        <select name="tipoContato" id="tipo" required <?php echo $tu?>>
                            <?php echo $select_valueC?>
                        </select>
                    </div>
                    <div class="Vcontato info">
                        <label for="Vcontato">Contato</label>
                        <input type="text" name="Vcontato" required>
                    </div>
                    <?php
                        if($nome_turma == "Sem turma"){
                            $nova_turma = "false";
                        }else{
                            $nova_turma = "true";
                        }
                    ?>
                    <input type="hidden" name="temTurma" value="<?php echo $nova_turma?>">
                    <input type="hidden" name="valor" value="<?php echo $id?>">
                    <input type="submit" value="<?php echo $do?>" id='submitButton' name="acao">

                </form>
            </main>
            <?php 
            //  Vai buscar qualquer tipo de informação que vem pela Url 
                if(isset($_GET["error"]) && $_GET["error"] === "1"){
                    echo "Preencha todos os dados!";
                }else if(isset($_GET["error"]) && $_GET["error"] === "0"){
                    echo "Dados cadastrados com sucesso!!";
                }
            ?>
        </article>
    </body>

<html>