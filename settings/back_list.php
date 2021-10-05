<?php 
    include_once('connections/connect.php');
    include_once('functions.php');

    if(isset($_GET["id"])){
         $ID_usuario = $_GET["id"];
            for($x=0;$x<3;$x++){
                $sql0 = "DELETE FROM observacoes WHERE id_usuario = $ID_usuario";
                $sql1 = "DELETE FROM contato_professor WHERE ID_usuario = $ID_usuario";
                $sql = "DELETE FROM usuario_turma WHERE ID_usuario = $ID_usuario";
                $sql2 = "DELETE FROM lembrete WHERE ID_usuario = $ID_usuario";
                $sql4 = "DELETE FROM atividade WHERE ID_usuario = $ID_usuario";
                $sqli = "DELETE FROM usuario WHERE ID_usuario = $ID_usuario";
                
                mysqli_query($bd, $sql0) or die(mysqli_error($bd));
                mysqli_query($bd, $sql1) or die(mysqli_error($bd));
                mysqli_query($bd, $sql) or die(mysqli_error($bd));
                mysqli_query($bd, $sql2) or die(mysqli_error($bd));
                mysqli_query($bd, $sql4) or die(mysqli_error($bd));
                mysqli_query($bd, $sqli) or die(mysqli_error($bd));
            }

         header("location: /TCC/visualization/front_list.php");
    }

    
    if(isset($_POST["searching"]) && $_POST["searching"] == "Procurar" && $_POST["searching-input"] != ""){
        $pesquisa = $_POST['searching-input'];
        $sql = "SELECT * FROM usuario WHERE Nome LIKE '$pesquisa%'";
    }else{
        $pesquisa = "";
        $sql = "SELECT * FROM usuario order by nome";
    }

    $pesquisar = "<form method = 'POST'> 
                    <input type='text' name='searching-input' id='searching' value='$pesquisa' >
                    <input type='submit' name='searching' id='btn' value='Procurar'>
                </form>";

    $result = mysqli_query($bd, $sql);
    $aux = 0;
    if(mysqli_num_rows($result) > 0){
        $table='';
        while($dados = mysqli_fetch_assoc($result)){
            // $dados2 = mysqli_fetch_assoc($result2);
            $table = $table."<div id='controle$aux' class='classItem' onclick='muda($aux)'>";
            $nome = $dados["Nome"];
            $sobrenome = $dados["Sobrenome"];
            $tipo = $dados["Tipo_usuario"];
            $id = $dados["ID_usuario"];
            $aniver = $dados['Data_nascimento'];
            $idUsuario = $dados['ID_usuario'];

            if($tipo == "P"){
                $tipo = 'Professor';
            }else{
                $tipo = 'Diretor';
            }

            $sql = "select turma.nome_turma from turma, usuario, usuario_turma 
            where usuario_turma.id_turma = turma.id_turma && usuario_turma.ID_usuario = usuario.ID_usuario && usuario_turma.ID_usuario = $id";

            $sqlContato = "SELECT * from contato_professor where id_usuario =  $idUsuario";
            $resultadoContato = mysqli_query($bd, $sqlContato);
            $dadosContato = mysqli_fetch_assoc($resultadoContato);
            $tipoContato = $dadosContato['tipo_contato'];
            $contato = $dadosContato['contato'];

            $resultado = mysqli_query($bd, $sql)or die(mysqli_error($bd));
            $dados = mysqli_fetch_assoc($resultado);
    

            if(is_array($dados)){
                $turma = $dados["nome_turma"];
            }else{
                $turma = "";
            }

            $excluir = "<input type='button' id='btn' name='acao' value='Excluir' onclick='confirma($id)'>";
            
            $editar = "<form action='../visualization/teacherRegister.php' method='POST'>
                            <input type='hidden' name='valor' value='$id'>
                            <input type='submit' name='acao' id='btn' value='Editar'>
                        </form>";

            $table = $table."<div class='prin'><p class='PInfo'>$nome  $sobrenome</p><p class='PInfo'>$turma</p><div class='btnContainer'>$excluir $editar</div></div><span id='desc'>$tipo <br> Aniversário: $aniver <br> $tipoContato : $contato </span></div>";
            $aux++;
        }
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

    function muda(aux){
        const  lisAtv = document.getElementById("controle"+aux);
        
        lisAtv.classList.toggle('click');
    }
</script>

<script>

</script>