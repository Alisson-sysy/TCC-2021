<script>

    function abr(path){
        document.getElementById("imgTrabalho").src = path;
        document.getElementById("imgTrabalho").style.display = "block";
        document.getElementById("imgAtividadeContainer").style.display = "block";

    }

    function voltar(){
        document.getElementById("imgTrabalho").src = "";
        document.getElementById("imgTrabalho").style.display = "none";
        document.getElementById("imgAtividadeContainer").style.display = "none";
    }

</script>
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

        $pai = $dados['nome_pai'];
        $mae = $dados['nome_mãe'];
        $nome = $dados["nome"];
        $sobrenome = $dados["sonbrenome"];
        $turma = $dados["id_turma"];
        $data = $dados["data_nascimento"];  
        $foto = $dados["foto"];
        $mensagem = $nome;

        $sql2 = "SELECT * FROM observacoes WHERE id_aluno = $id_aluno";
        $resultado2 = mysqli_query($bd, $sql2);
        $dados2 = mysqli_fetch_assoc($resultado2);
        $div = "<p>Não há observações sobre o aluno(a) $nome</p>";
        if(is_array($dados2)){
            $div = "<div class='observacoes'>";
            while($dados3 = mysqli_fetch_assoc($resultado2)){
                $div = $div."<div class='obsUn'>";
                $obs = $dados3["observacao"];
                $idObs = $dados3["id_observacoes"];
                $div = $div."<p class='obs'>$obs</p>";
                if($_SESSION["tipo"] == "P"){
                    $div = $div."<form action='/TCC/settings/Alunos/maisInfoBack/maisInfoback.php' method='POST'>
                                    <input type='hidden' name='idAluno' value='$id_aluno'>
                                    <input type='hidden' name='idObs' value='$idObs'>
                                    <input type='submit' name='excluir' id='excluirObs' value='Excluir'>
                                </form>
                                ";
                }
                $div = $div."</div>";
            }
            $div = $div."</div>";
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

        $sqlSelectTurma = "SELECT * from atividade where id_turma = $turma";
        $resultado = mysqli_query($bd, $sqlSelectTurma) or die(mysqli_error($bd));
        $row = mysqli_num_rows($resultado);

        $divAtv = "<div class='listAtividades'>";
        $h = 0;
        if($row > 0){
            
            while($dados = mysqli_fetch_assoc($resultado)){
                $entrega = "";
                $conf = "";
                $idAtividade = $dados["id_atividade"];
                $nomeAtivide = $dados['nome_atividade'];
                $sqlSelectAtividade = "SELECT * from entrega where id_atividade = $idAtividade";
                $resultadoAtividade = mysqli_query($bd, $sqlSelectAtividade) or die(mysqli_error($bd));
                $rowAtividade = mysqli_num_rows($resultadoAtividade);

                if($rowAtividade > 0){
                    $sqlSelectEntrega = "SELECT * from entrega where id_atividade = $idAtividade and id_aluno = $id_aluno";
                    $resultadoEntrega = mysqli_query($bd, $sqlSelectEntrega) or die(mysqli_error($bd));
                    $rowEntrega = mysqli_num_rows($resultadoEntrega);
                    $fotoButton = '';
                    if($rowEntrega > 0){
                        $dadosEntrega = mysqli_fetch_assoc($resultadoEntrega);
                        $conf = $dadosEntrega["confirmacao"]; 
                        $fotoCaminho = $dadosEntrega['foto'];

                        $idAtividade = $dadosEntrega['id_atividade'];
                        $sqlDadosAtividade = "SELECT * from atividade where id_atividade = $idAtividade";
                        $resultadoAtividade = mysqli_query($bd, $sqlDadosAtividade) or die(mysqli_error($bd));
                        $dadosAtividade = mysqli_fetch_assoc($resultadoAtividade);
                        $nomeAtividade = $dadosAtividade['nome_atividade'];
                        if(!empty($fotoCaminho)){
                            $fotoButton = "<input type='button' id='btnImg' onclick='abr(`$fotoCaminho`)' value='Ver imagem'>";
                        }
                        $img = "<p class='imgTextTopo' id='imgTextTop'>Nome da atividade: $nomeAtividade</p><img src='' id='imgTrabalho'><p class='igmTextBottom' id='imgTextBottom'>Clique em qualquer lugar para fechar a imagem</p>";
                        if($conf == "E"){
                            $entrega = "Feito";
                        }else{
                            $entrega = "Não feito";
                        }
                    }else{
                        $entrega = "Não Entregue";
                    }
                }else{
                    $entrega = "Não entregue";
                }
                $divAtv = $divAtv."<div class='ctt'>";
                $divAtv = $divAtv."<p>$nomeAtivide</p>$fotoButton<span class='entrega'>$entrega</span>";
                $divAtv = $divAtv."</div>";
            }
        }else{
            $divAtv = $divAtv."<p>O aluno(a) $nome não tem atividades</p>";
        }
        $divAtv = $divAtv."<div id='imgAtividadeContainer' onclick='voltar()'>$img</div>";
        $divAtv = $divAtv. "</div>";

    }

    if(isset($_POST["excluir"])){
        $idObs = $_POST['idObs'];
        $idAluno = $_POST['idAluno'];

        $sqlDelete = "DELETE from observacoes where id_observacoes = $idObs";

        mysqli_query($bd, $sqlDelete) or die(mysqli_error($bd));

        header("location: http://localhost/TCC/visualization/alunos/maisInfo/maisInfo.php?id=$idAluno");
        
    }
?>