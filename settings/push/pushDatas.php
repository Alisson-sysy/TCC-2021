<?php
    $path = dirname(__FILE__) . '/../functions.php';
    $path2 = dirname(__FILE__) . '/../check_session.php';
    $path3 = dirname(__FILE__) . '/../connect.php';

    include($path);
    include($path2); 
    include($path3); 
    
    $name_user = "";
    $birthday = "";
    $tipo = "";
    $sobrenome = "";

    if(isset($_POST["acao"])){
        //get all datas of php
        $acao = "";

        if($_POST["acao"] === "Adicionar"){

        $name_user = $_POST["nome"] != ""? mysqli_real_escape_string($bd, $_POST["nome"]): header("location: /TCC/visualization/teacherRegister.php?error=1");
        $birthday = $_POST["data"] != ""? mysqli_real_escape_string($bd, $_POST["data"]): header("location: /TCC/visualization/teacherRegister.php?error=1");
        $tipo = $_POST["tipo"] != ""? mysqli_real_escape_string($bd, $_POST["tipo"]): header("location: /TCC/visualization/teacherRegister.php?error=1");
        $sobrenome = $_POST["sobrenome"] != ""? mysqli_real_escape_string($bd, $_POST["sobrenome"]): header("location: /TCC/visualization/teacherRegister.php?error=1");
        $turma = $_POST["turma"] != ""? mysqli_real_escape_string($bd, $_POST["turma"]): header("location: /TCC/visualization/teacherRegister.php?error=1");
            // Adicionar um novo professor
            $sql_code = "INSERT INTO usuario (Nome, Sobrenome, Data_nascimento, Tipo_usuario)
                         VALUES
                         ('$name_user', '$sobrenome', '$birthday', '$tipo')";
            

            if(!mysqli_query($bd, $sql_code) && !mysqli_query($bd, $sql_codeT)){

                if ( mysqli_errno($bd) == 1062 ) {
                    $mensagem = "<h3>Prezado usuário o valor escolhido '$' já está sendo utilizado. Escolha outro!</h3>";
                } else {
                    $mensagem = "<h3>Ocorreu um erro ao inserir os dados: </h3> <h3>".mysqli_error($bd)."</h3> <h4>".mysqli_errno($bd)."</h4>";
                }
            }else{
                $acao = "adicionados";
                $new_user = mysqli_insert_id($bd);
                //vincular um professor a uma turma
                if($tipo === "P"){
                    if($turma === ""){
                        header("location: ../../visualization/teacherRegister.php?error=3");
                    }else{
                        $sql_codeT = "INSERT INTO usuario_turma (ID_usuario, id_turma)
                            VALUES
                        ($new_user, $turma)";

                        if(!mysqli_query($bd, $sql_codeT)){

                            if ( mysqli_errno($bd) == 1062 ) {
                                $mensagem = "<h3>Prezado usuário o valor escolhido '$' já está sendo utilizado. Escolha outro!</h3>";
                            } else {
                                $mensagem = "<h3>Ocorreu um erro ao inserir os dados: </h3> <h3>".mysqli_error($bd)."</h3> <h4>".mysqli_errno($bd)."</h4>";
                            }
                            echo $mensagem;
                        }
                    }
                }

                header("location: ../../visualization/teacherRegister.php?error=0");
                // Construção de uma senha e de um login aleatório para o novo usuário

                // O mysqli_insert_id vai pegar o último dado inserido no BD

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

                //Vai mandar as senhas aleatórias para o banco
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
                }else{
                    header("location: /TCC/visualization/teacherRegister.php");
                }
            }
        
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
        }else if($_POST["acao"] === "Salvar"){

            $id = $_POST["valor"] != ""? mysqli_real_escape_string($bd, $_POST["valor"]): header("location: /TCC/visualization/front_list.php?error=1");;
            $name_user = $_POST["nome"] != ""? mysqli_real_escape_string($bd, $_POST["nome"]): header("location: /TCC/visualization/teacherRegister.php?error=1");
            $birthday = $_POST["data"] != ""? mysqli_real_escape_string($bd, $_POST["data"]): header("location: /TCC/visualization/teacherRegister.php?error=1");
            $tipo = $_POST["tipo"] != ""? mysqli_real_escape_string($bd, $_POST["tipo"]): header("location: /TCC/visualization/teacherRegister.php?error=1");
            $sobrenome = $_POST["sobrenome"] != ""? mysqli_real_escape_string($bd, $_POST["sobrenome"]): header("location: /TCC/visualization/teacherRegister.php?error=1");
            $turma = $_POST["turma"] != ""? mysqli_real_escape_string($bd, $_POST["turma"]): header("location: /TCC/visualization/teacherRegister.php?error=1");
            $nova_turma = $_POST["temTurma"] != ""? mysqli_real_escape_string($bd, $_POST["temTurma"]): header("location: /TCC/visualization/teacherRegister.php?error=1");
            
            if($nova_turma === "true"){
                $sql = "UPDATE usuario, usuario_turma SET 
                    usuario.nome = '$name_user',
                    usuario.Sobrenome = '$sobrenome',
                    usuario.Data_nascimento = '$birthday',
                    usuario.Tipo_usuario = '$tipo', 
                    usuario_turma.id_turma = $turma
                        WHERE
                    usuario.ID_usuario = $id
                        &&
                    usuario_turma.ID_usuario = $id
                    ";
            }else{
                $sql = "UPDATE usuario SET 
                usuario.nome = '$name_user',
                usuario.Sobrenome = '$sobrenome',
                usuario.Data_nascimento = '$birthday',
                usuario.Tipo_usuario = '$tipo'
                    WHERE
                usuario.ID_usuario = $id";
                
                if(!mysqli_query($bd, $sql)){
                    if ( mysqli_errno($bd) == 1062 ) {
                        $mensagem = "<h3>Prezado usuário o valor escolhido '$' já está sendo utilizado. Escolha outro!</h3>";
                    } else {
                        $mensagem = "<h3>Ocorreu um erro ao inserir os dados: </h3> <h3>".mysqli_error($bd)."</h3> <h4>".mysqli_errno($bd)."</h4>";
                    }
                    echo $mensagem;
                }

                $sql2 = "INSERT INTO usuario_turma VALUES ($id, $turma)";

                if(!mysqli_query($bd, $sql2)){
                    if ( mysqli_errno($bd) == 1062 ) {
                        $mensagem = "<h3>Prezado usuário o valor escolhido '$' já está sendo utilizado. Escolha outro!</h3>";
                    } else {
                        $mensagem = "<h3>Ocorreu um erro ao inserir os dados: </h3> <h3>".mysqli_error($bd)."</h3> <h4>".mysqli_errno($bd)."</h4>";
                    }
                    echo $mensagem;
                } 
                
            }
            
            if(!mysqli_query($bd, $sql)){
                if ( mysqli_errno($bd) == 1062 ) {
                    $mensagem = "<h3>Prezado usuário o valor escolhido '$' já está sendo utilizado. Escolha outro!</h3>";
                } else {
                    $mensagem = "<h3>Ocorreu um erro ao inserir os dados: </h3> <h3>".mysqli_error($bd)."</h3> <h4>".mysqli_errno($bd)."</h4>";
                }
                echo $mensagem;
            }else{ 
                header("location: /TCC/visualization/front_list.php?confi=1");
            }

        }
    }
?>