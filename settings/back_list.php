<?php 
    include_once('connections/connect.php');
    include_once('functions.php');

    if(isset($_GET["id"])){
         $ID_usuario = $_GET["id"];
            for($x=0;$x<3;$x++){
                $sql0 = "DELETE FROM observacoes WHERE id_usuario = $ID_usuario";
                $sql1 = "DELETE FROM contato_professor WHERE ID_usuario = $ID_usuario";
                $sql = "DELETE FROM usuario_turma WHERE ID_usuario = $ID_usuario";
                $sqli = "DELETE FROM usuario WHERE ID_usuario = $ID_usuario";
                
                mysqli_query($bd, $sql0) or die(mysqli_error($bd));
                mysqli_query($bd, $sql1) or die(mysqli_error($bd));
                mysqli_query($bd, $sql) or die(mysqli_error($bd));
                mysqli_query($bd, $sqli) or die(mysqli_error($bd));
            }
         header("location: /TCC/visualization/front_list.php");
    }

    
    if(isset($_POST["searching"]) && $_POST["searching"] == "Procurar" && $_POST["searching-input"] != ""){
        $pesquisa = $_POST['searching-input'];
        $sql = "SELECT * FROM usuario WHERE Nome LIKE '$pesquisa%'";
    }else{
        $pesquisa = " ";
        $sql = "SELECT * FROM usuario order by nome";
    }

    $pesquisar = "<form method = 'POST'>
                    <label for='searching'>Procurar</label>
                    <input type='text' name='searching-input' id='searching' value='$pesquisa'>
                    <input type='submit' name='searching' value='Procurar'>
                </form>";

    $result = mysqli_query($bd, $sql);

    if(mysqli_num_rows($result) > 0){
        $table = "<table class='tabela-list' id='tabela-list' border=1>";
        $table = $table."<tr><th>Nome</th><th>Sobrenome</th><th>Tipo de usuário</th><th>Turma</th><th>Excluir</th><th>Editar</th></tr>";

        while($dados = mysqli_fetch_assoc($result)){
            // $dados2 = mysqli_fetch_assoc($result2);

            $nome = $dados["Nome"];
            $sobrenome = $dados["Sobrenome"];
            $tipo = $dados["Tipo_usuario"];
            $id = $dados["ID_usuario"];

            $sql = "select turma.nome_turma from turma, usuario, usuario_turma 
            where usuario_turma.id_turma = turma.id_turma && usuario_turma.ID_usuario = usuario.ID_usuario && usuario_turma.ID_usuario = $id";

            $resultado = mysqli_query($bd, $sql);
            $dados = mysqli_fetch_assoc($resultado);

            if(is_array($dados)){
                $turma = $dados["nome_turma"];
            }else{
                $turma = "Sem turma";
            }

            $excluir = "<input type='button' name='acao' value='excluir' onclick='confirma($id)'>";
            
            $editar = "<form action='../visualization/teacherRegister.php' method='POST'>
                            <input type='hidden' name='valor' value='$id'>
                            <input type='submit' name='acao' value='editar'>
                        </form>";

            $table = $table."<tr><td>$nome</td><td>$sobrenome</td><td>$tipo</td><td>$turma</td><td>$excluir</td><td>$editar</td></tr>";

        }
        $table = $table."</table>";
    }else{
        $table = "Não há registros";
    }
?>

<script>
    function confirma(caminho){  
        alert("Apagar um professor? Tem certeza sobre isso?");
        confirm = confirm('Se você apagar esse professor(a), todas as obervações, turmas entre outras informações lincadas a ele(a), serão apagados também');
        if(confirm){
            window.location.href = "/TCC/settings/back_list.php?id="+caminho;
        }else{
            window.location.href = "/TCC/visualization/front_list.php";
        }   
    }
</script>