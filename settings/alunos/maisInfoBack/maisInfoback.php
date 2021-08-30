<?php
    $path = dirname(__FILE__) . '/../../connections/connect.php';
    include($path);


    if(isset($_POST["acao"]) && $_POST["acao"] === "Ver mais" || isset($_GET["id"])){
        if(isset($_GET["id"])){
            $id_aluno = $_GET["id"];
        }else{
            $id_aluno = $_POST["valor"];
        }
        
        $criarContato = 'newCtt';
        $criarContatoText = 'Criar novo contato';
        $newLembrete = '';

        $sql = "SELECT * FROM aluno WHERE id_aluno = $id_aluno";
        $resultado = mysqli_query($bd, $sql);
        $dados = mysqli_fetch_assoc($resultado);

        $nome = $dados["nome"];
        $sobrenome = $dados["sonbrenome"];
        $turma = $dados["id_turma"];
        $data = $dados["data_nascimento"];  
        $foto = $dados["foto"];
        $mensagem = $nome;

        $sql2 = "SELECT observacao FROM observacoes WHERE id_aluno = $id_aluno";
        $resultado2 = mysqli_query($bd, $sql2);
        $dados2 = mysqli_fetch_assoc($resultado2);
        $obs = "Não há observações sobre o aluno(a) $nome";
        if(is_array($dados2)){
            $obs = $dados2["observacao"];
        }



        $sql4 = "SELECT turma.nome_turma, turma.id_turma FROM turma, aluno WHERE aluno.id_turma = turma.id_turma && aluno.id_aluno = $id_aluno";
        $resultado4 = mysqli_query($bd, $sql4);
        $dados4 = mysqli_fetch_assoc($resultado4);

        $nomeTurma = $dados4["nome_turma"];

        $idTurmaAluno = $dados4["id_turma"];

        $sql5 = "SELECT usuario.nome FROM usuario, usuario_turma, turma WHERE usuario.ID_usuario = usuario_turma.id_usuario && turma.id_turma = usuario_turma.id_turma &&  turma.id_turma = $idTurmaAluno;";
        $resultado5 = mysqli_query($bd, $sql5);
        $dados5 = mysqli_fetch_assoc($resultado5);
        if(is_array($dados5)){
            $nomeProfessor = $dados5["nome"];
        }else{
            $nomeProfessor = "A turma está sem professor";
        }

    }
?>