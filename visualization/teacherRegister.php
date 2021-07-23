<?php include_once("../settings/check_session.php");?>
<?php include_once("../settings/functions.php")?>

<!DOCTYPE html>

    <head>
        <meta charset="utf-8" />
        <title>Cadastro Professor</title>
    </head>
    <body>

        <article>
            <h3>Dados do professor</h3>
            <!-- Vai gerar o select de opções -->
            <?php
                $value = array('D', 'P');
                $description = array('Diretor', 'Professor');
                $select_value = makeSelect($value, $description);
            ?>

            <!-- Formulário -->
            <form action="../settings/push/pushDatas.php" method="POST">

                <div class="primeiro_nome">
                    <label>Primeiro Nome</label>
                    <input type="text" name='nome' required>
                </div>
                <div class='sobrenome'>
                    <label>Segundo nome</label>
                    <input type="text" name='sobrenome' required>
                </div>
                <!-- Add last name of usuario -->
                <div class="data_nascimento">  
                    <label>Data de nascimento</label>
                    <input type="date" name='data' required>
                </div>

                <div class="tipo_usuario">
                    <label>Tipo do usuário</label>
                    <select name="tipo" id="tipo" required>
                        <?php echo $select_value?>
                    </select>
                </div>
                
                <input type="submit" value="create" name="acao">

            </form>
            <!-- Vai pegar, caso exista algum, erro que vai ser passado pela URL -->
            <?php 
                if(isset($_GET["error"]) && $_GET["error"] === "1"){
                        echo "Preencha todos os dados!";
                }
                    ?>
        </article>
    </body>

<html>