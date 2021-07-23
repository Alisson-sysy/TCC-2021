<?php
    include_once('../connect.php');
    include_once('../functions.php');

    if(isset($_POST["acao"])){
        //get all datas of php
        $acao = "";
        
        if($_POST["acao"] === "create"){

            $name_user = $_POST["nome"] != ""? mysqli_real_escape_string($bd, $_POST["nome"]): header("location: ../../visualization/teacherRegister.php?error=1");
            $birthday = $_POST["data"] != ""? mysqli_real_escape_string($bd, $_POST["data"]): header("location: ../../visualization/teacherRegister.php?error=1");
            $tipo = $_POST["tipo"] != ""? mysqli_real_escape_string($bd, $_POST["tipo"]): header("location: ../../visualization/teacherRegister.php?error=1");
            $sobrenome = $_POST["sobrenome"] != ""? mysqli_real_escape_string($bd, $_POST["sobrenome"]): header("location: ../../visualization/teacherRegister.php?error=1");
            
            $sql_code = "INSERT INTO usuario (Nome, Sobrenome, Data_nascimento, Tipo_usuario)
                         VALUES
                         ('$name_user', '$sobrenome', '$birthday', '$tipo')";
            
            if(!mysqli_query($bd, $sql_code)){

                if ( mysqli_errno($bd) == 1062 ) {
                    $mensagem = "<h3>Prezado usuário o valor escolhido '$' já está sendo utilizado. Escolha outro!</h3>";
                } else {
                    $mensagem = "<h3>Ocorreu um erro ao inserir os dados: </h3> <h3>".mysqli_error($bd)."</h3> <h4>".mysqli_errno($bd)."</h4>";
                }
            }else{
                $acao = "adicionados";
                $mensagem = "<h3>Todos os dados foram $acao com sucesso<h3>";

                // Construção de uma senha e de um login aleatório para o novo usuário

                // O mysqli_insert_id vai pegar o último dado inserido no BD
                $new_user = mysqli_insert_id($bd);

                // gera uma senha aleatória
                $random_password = rand(1000, 9999);
                $letras =array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
                for($x=1; $x<=3; $x++){
                    $random_lyrics  = rand(0, 25);
                    $random_password .= $letras[$random_lyrics];
                }

                //gera um login aleatorio
                $random_login_number = rand(1000, 9999);
                $login_random = $name_user.$tipo.$random_login_number;

                $sql_code = "UPDATE usuario SET
                                Login = '$login_random',
                                password = '$random_password',
                                Logado = 'N'
                            where
                                ID_usuario = $new_user";

                if(!mysqli_query($bd, $sql_code)){

                if ( mysqli_errno($bd) == 1062 ) {
                    $mensagem = "<h3>Prezado usuário o valor escolhido '$' já está sendo utilizado. Escolha outro!</h3>";
                } else {
                    $mensagem = "<h3>Ocorreu um erro ao inserir os dados: </h3> <h3>".mysqli_error($bd)."</h3> <h4>".mysqli_errno($bd)."</h4>";
                }
            }
            }
        echo $mensagem;
        
        }else if($_POST["acao"] === "Modificar_Login"){
            $login = $_POST["login"] != ""? mysqli_real_escape_string($bd, $_POST["login"]): header("location: ../../visualization/Troca_senha.php?error=1");
            $password = $_POST["password"] != ""? mysqli_real_escape_string($bd, $_POST["password"]): header("location: ../../visualization/Troca_senha.php?error=1");

            session_start();
            $id_usuario = $_SESSION["id"];
            $sql_code = "UPDATE usuario SET
                                Login = '$login',
                                password = '$password',
                                logado = 'S'
                            where
                            ID_usuario = $id_usuario";

            if(!mysqli_query($bd, $sql_code)){

                if ( mysqli_errno($bd) == 1062 ) {
                    $mensagem = "<h3>Prezado usuário o valor escolhido '$' já está sendo utilizado. Escolha outro!</h3>";
                } else {
                    $mensagem = "<h3>Ocorreu um erro ao inserir os dados: </h3> <h3>".mysqli_error($bd)."</h3> <h4>".mysqli_errno($bd)."</h4>";
                }
                echo $mensagem;
            }else{
                header("location: ../../visualization/home.php");
            }
        }
    }
?>