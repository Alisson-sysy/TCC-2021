<?php
    include_once("../../../settings/connections/connect.php");

    if(isset($_POST["acao"])){
        $mensagem = "";
        $nome = isset($_POST["nome"]) ? mysqli_real_escape_string($bd, $_POST["nome"]): header("location: /TCC/visualization/alunos/creatAlunos/createAlunos.php?error=1");
        $foto = $_FILES["foto"];
        $sobrenome = isset($_POST["sobrenome"]) ? mysqli_real_escape_string($bd, $_POST["sobrenome"]) : header("location: /TCC/visualization/alunos/creatAlunos/createAlunos.php?error=1");
        $data = isset($_POST["data"])? mysqli_real_escape_string($bd, $_POST["data"]): header("location: /TCC/visualization/alunos/creatAlunos/createAlunos.php?error=1");
        $nomeTurma = isset($_POST["nomeTurma"])? mysqli_real_escape_string($bd, $_POST["nomeTurma"]): header("location: /TCC/visualization/alunos/creatAlunos/createAlunos.php?error=1");;
        $nomePai = isset($_POST["nomePai"])? mysqli_real_escape_string($bd, $_POST["nomePai"]): header("location: /TCC/visualization/alunos/creatAlunos/createAlunos.php?error=1");
        $nomeMae = isset($_POST["nomeMae"])? mysqli_real_escape_string($bd, $_POST["nomeMae"]): header("location: /TCC/visualization/alunos/creatAlunos/createAlunos.php?error=1");
        $id = isset($_POST["id"])? mysqli_real_escape_string($bd, $_POST["id"]): header("location: /TCC/visualization/alunos/creatAlunos/createAlunos.php?error=1");

        if(isset($_POST["obs"])){
            $obs = mysqli_real_escape_string($bd, $_POST["obs"]);
        }

        //Se a foto existir
        if (!empty($foto["name"])){
                
            $nome_imagem = "amogus";
            // Largura máxima em pixels
            $largura = 1500;
            // Altura máxima em pixels
            $altura = 1800;
            // Tamanho máximo do arquivo em bytes
            $tamanho = 10000000;
        
            $error = array();
        
            // Verifica se o arquivo é uma imagem
            if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
                $error[1] = "Isso não é uma imagem.";
            } 
            
            // Pega as dimensões da imagem
            $dimensoes = getimagesize($foto["tmp_name"]);
            
            // Verifica se a largura da imagem é maior que a largura permitida
            if($dimensoes[0] > $largura) {
                $error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
            }
        
            // Verifica se a altura da imagem é maior que a altura permitida
            if($dimensoes[1] > $altura) {
                $error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
            }
                
            // Verifica se o tamanho da imagem é maior que o tamanho permitido
            if($foto["size"] > $tamanho) {
                $error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
            }
        
            // Se não houver nenhum erro
            if (count($error) == 0) {
                
                // Pega extensão da imagem
                preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
        
                // Gera um nome único para a imagem
                $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

                // Caminho de onde ficará a imagem
                $caminho_imagem = "../maisInfoBack/fotos/" . $nome_imagem;
                $caminhoImgDireto = "/TCC/settings/alunos/maisInfoBack/fotos/" . $nome_imagem;
                // Faz o upload da imagem para seu respectivo caminho
                move_uploaded_file($foto["tmp_name"], $caminho_imagem);
                    
            }
            
            // Se houver mensagens de erro, exibe-as
             if (count($error) != 0) {
                foreach ($error as $erro) {
                    echo $erro . "<br />";
                }
            }
        }

        if($_POST["acao"] == "Adicionar aluno"){

            $Tcontato = isset($_POST["tipoContato"])? mysqli_real_escape_string($bd, $_POST["tipoContato"]): header("location: /TCC/visualization/alunos/creatAlunos/createAlunos.php?error=1");
            $Vcontato = isset($_POST["Vcontato"])? mysqli_real_escape_string($bd, $_POST["Vcontato"]): header("location: /TCC/visualization/alunos/creatAlunos/createAlunos.php?error=1");

            $sql_code = "INSERT INTO aluno(id_turma, nome, sonbrenome, foto, data_nascimento, nome_pai, nome_mãe)
                VALUES
            ('$nomeTurma', '$nome', '$sobrenome', '$caminhoImgDireto', '$data', '$nomePai', '$nomeMae')";
                        
            if(!mysqli_query($bd, $sql_code)){

                if ( mysqli_errno($bd) == 1062 ) {
                    $mensagem = "<h3>Prezado usuário o valor escolhido '$' já está sendo utilizado. Escolha outro!</h3>";
                } else {
                    $mensagem = "<h3>Ocorreu um erro ao inserir os dados: </h3> <h3>".mysqli_error($bd)."</h3> <h4>".mysqli_errno($bd)."</h4>";
                }
            }else{

                $last_user = mysqli_insert_id($bd);
                $sql_code = "INSERT INTO contato_aluno(id_aluno, tipo_contato, contato)
                                VALUES
                            ('$last_user', '$Tcontato', '$Vcontato')";

                if(!mysqli_query($bd, $sql_code)){

                    if ( mysqli_errno($bd) == 1062 ) {
                        $mensagem2 = "<h3>Prezado usuário o valor escolhido '$' já está sendo utilizado. Escolha outro!</h3>";
                    } else {
                        $mensagem2 = "<h3>Ocorreu um erro ao inserir os dados: </h3> <h3>".mysqli_error($bd)."</h3> <h4>".mysqli_errno($bd)."</h4>";
                    }
                }else{
                    header("location: /TCC/settings/alunos/lista/back_list.php?id=$nomeTurma");
                }
            }
            echo $mensagem;
            echo $mensagem2;
   
        }else if($_POST["acao"] == "Salvar"){
            $sql_code = "UPDATE aluno SET
                            id_turma = '$nomeTurma',
                            nome = '$nome',
                            sonbrenome = '$sobrenome',
                            data_nascimento = '$data',
                            nome_pai = '$nomePai',
                            nome_mãe = '$nomeMae'
                        where
                            id_aluno = $id";
                            
            //Caso haja algum erro..
            if(!mysqli_query($bd, $sql_code)){
                //o sistema vai verificar se o mesmo é do tipo 1062 (Duplicação de chave primaria)
                if ( mysqli_errno($bd) == 1062 ) {
                    $mensagem = "<h3>Prezado usuário o valor escolhido '$' já está sendo utilizado. Escolha outro!</h3>";
                    //ou 
                }else{
                    $mensagem = "<h3>Ocorreu um erro ao inserir os dados: </h3> <h3>".mysqli_error($bd)."</h3> <h4>".mysqli_errno($bd)."</h4>";
                }
            }else{
                header("location: http://localhost/TCC/settings/alunos/lista/back_list.php?id=$nomeTurma&&error=3");
            }
        }
    }

    if(isset($_POST["mudar"]) && $_POST["mudar"] == "Mudar a turma"){
        $atualTurma = $_POST["idTurma"];
        $novaTurma = $_POST["novaTurma"];

        $sql_code = "UPDATE aluno SET
                            id_turma = $novaTurma
                        where
                            id_turma = $atualTurma";

        if(!mysqli_query($bd, $sql_code)){
            if ( mysqli_errno($bd) == 1062 ) {
                $mensagem = "<h3>Prezado usuário o valor escolhido '$' já está sendo utilizado. Escolha outro!</h3>";
            }else{
                $mensagem = "<h3>Ocorreu um erro ao inserir os dados: </h3> <h3>".mysqli_error($bd)."</h3> <h4>".mysqli_errno($bd)."</h4>";
            }
        }else{
            header("location: http://localhost/TCC/settings/alunos/lista/back_list.php?id=$novaTurma");
        }

    }

    if(isset($_POST["alterImg"])){
        $foto = $_FILES["foto"];
        $id_aluno = $_POST["id_aluno"];
        $id_turma = $_POST["idturma"];

        //Se a foto existir
        if (!empty($foto["name"])){
                
            $nome_imagem = "";
            // Largura máxima em pixels
            $largura = 6541651651;
            // Altura máxima em pixels
            $altura = 984898;
            // Tamanho máximo do arquivo em bytes
            $tamanho = 10000000;
        
            $error = array();
        
            // Verifica se o arquivo é uma imagem
            if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
                $error[1] = "Isso não é uma imagem.";
            } 
            
            // Pega as dimensões da imagem
            $dimensoes = getimagesize($foto["tmp_name"]);
            
            // Verifica se a largura da imagem é maior que a largura permitida
            if($dimensoes[0] > $largura) {
                $error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
            }
        
            // Verifica se a altura da imagem é maior que a altura permitida
            if($dimensoes[1] > $altura) {
                $error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
            }
                
            // Verifica se o tamanho da imagem é maior que o tamanho permitido
            if($foto["size"] > $tamanho) {
                $error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
            }
        
            // Se não houver nenhum erro
            if (count($error) == 0) {
                
                // Pega extensão da imagem
                preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
        
                // Gera um nome único para a imagem
                $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

                // Caminho de onde ficará a imagem
                $caminho_imagem = "../maisInfoBack/fotos/" . $nome_imagem;
                $caminhoImgDireto = "/TCC/settings/alunos/maisInfoBack/fotos/" . $nome_imagem;
                // Faz o upload da imagem para seu respectivo caminho
                move_uploaded_file($foto["tmp_name"], $caminho_imagem);
                
                $sql_code = "UPDATE aluno SET
                    foto = '$caminhoImgDireto'
                        where
                    id_aluno = $id_aluno";
                
                if(!mysqli_query($bd, $sql_code)){
                    if ( mysqli_errno($bd) == 1062 ) {
                        $mensagem = "<h3>Prezado usuário o valor escolhido '$' já está sendo utilizado. Escolha outro!</h3>";
                    }else{
                        $mensagem = "<h3>Ocorreu um erro ao inserir os dados: </h3> <h3>".mysqli_error($bd)."</h3> <h4>".mysqli_errno($bd)."</h4>";
                    }
                }else{
                    header("location: /TCC/visualization/alunos/maisInfo/maisInfo.php?id=$id_aluno&&foto=$caminhoImgDireto");
                }
                
            }
            
            // Se houver mensagens de erro, exibe-as
             if (count($error) != 0) {
                foreach ($error as $erro) {
                    echo $erro . "<br />";
                }
            }
        }
    }

    
?>