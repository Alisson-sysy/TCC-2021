<script>

        function muda(x){
            document.getElementById("imgAtividade" + x).src = "/TCC/img/reflex-photo-camera-green.png"; 
        }
    

</script>
<?php

    date_default_timezone_set('America/Sao_Paulo');

    $pathConnect = dirname(__FILE__) . "./../../../settings/connections/connect.php";
    include_once($pathConnect);

    if(isset($_POST['idTurma'])){
        $idTurma = $_POST['idTurma'];
        $idAtividade = $_POST['idAtividade'];
    }else{
        $idTurma = $_GET['it'];
        $idAtividade = $_GET['ia'];
    }


  $sqlSelectAllAlunos = "select id_aluno from aluno where id_turma = $idTurma";
    $resultadoAluno = mysqli_query($bd, $sqlSelectAllAlunos) or die(mysqli_errno());

    $sqlSelectEntrega = "select id_aluno from entrega where id_atividade = $idAtividade";

    $resultadoEntrega = mysqli_query($bd, $sqlSelectEntrega) or die(mysqli_errno());
    $qtdResultado = mysqli_num_rows($resultadoEntrega);  

    $x = 0;
    $h = 0;
    $aux = 0;
    $valores = array();
    $valoresAlunoEntrega = array();
    $img = '';

    if(isset($_FILES['img'])){
        header("location:  http://localhost/TCC/visualization/atividades/progresso/addProgressoFront.php?ia=$idAtividade&&it=$idTurma&&i=s");
        $aux = 0;
    }else{
        $img = '/TCC/settings/atividade/fotosAtv/default.png';
    }

    if(isset($_GET['i'])){
        $img = $_FILES['img'];
    }

    $h = 0;
    
    if($qtdResultado == 0){
            $sqlSelect = "select * from aluno where id_turma = $idTurma";
            $resultado = mysqli_query($bd, $sqlSelect) or die(mysqli_errno());
            $div = "";
            while($dados = mysqli_fetch_assoc($resultado)){
                $foto = $dados["foto"];
                $nome = $dados["nome"];
                $sobrenome = $dados["sonbrenome"];
                $id = $dados['id_aluno'];

                $feito = 
                "  
                <form method='POST' enctype='multipart/form-data' action='/TCC/settings/Atividade/progresso/addProgressoBack.php?ia=$idAtividade&&it=$idTurma'>
                    <input type='hidden' name='aluno' value='$id'>
                    <input type='hidden' name='conf'>
                    <div class='label'>
                        <label for='foto$h'><img type='image' id='imgAtividade$h'  class='imgAtividade' src='/TCC/img/reflex-photo-camera.png'></label>
                        <input type='file' name='foto' id='foto$h' onchange='muda($h)'  hidden>
                    </div>
                    <div>
                        <label for='fz'>Fez</label>
                        <input type='radio' name='fz' value='fz'>
                    </div>
                    <div>
                        <label>Não fez</label>
                        <input type='radio' name='fz' value='fnz'>
                    </div>
                    <input type='submit' Value='Ok'>
                </form>
                ";

                $h++;

                    $div = $div."<div class='aluno'> $nome $sobrenome <div> $feito</div></div>";
                    $div = $div."";
            }
            

    }else{
        $h = 0;

        while($dadosEntrega = mysqli_fetch_assoc($resultadoEntrega)){
            $id_alunoEntrega = $dadosEntrega["id_aluno"];
            $valoresAlunoEntrega[$h] = $id_alunoEntrega;
            $h++;
        }

        $chegou = "aqui";
        while($dados = mysqli_fetch_assoc($resultadoAluno)){
            $aux = 0;
            $id_aluno = $dados["id_aluno"];
            for($c=0;$c<count($valoresAlunoEntrega);$c++){
                if($valoresAlunoEntrega[$c] == $id_aluno){
                    $aux ++;
                }
            }
            if($id_aluno == $id_alunoEntrega){
                $aux ++;
            }
            if($aux == 0){
                $valores[$x] = $id_aluno;
                $x++;
            }
        }

        $div = "<div>";

        for($y=0;$y<count($valores);$y++){
            $sqlSelect = "select * from aluno where id_aluno = $valores[$y]";
            $resultado = mysqli_query($bd, $sqlSelect) or die(mysqli_errno());
            while($dados = mysqli_fetch_assoc($resultado)){
                $foto = $dados["foto"];
                $nome = $dados["nome"];
                $sobrenome = $dados["sonbrenome"];
                $id = $dados['id_aluno'];


                $feito = 
                "  
                <form method='POST' enctype='multipart/form-data' action='/TCC/settings/Atividade/progresso/addProgressoBack.php?ia=$idAtividade&&it=$idTurma'>
                    <input type='hidden' name='aluno' value='$id'>
                    <input type='hidden' name='conf'>
                    <div class='label'>
                        <label for='foto'><img type='image' id='imgAtividade$h'  class='imgAtividade' src='/TCC/img/reflex-photo-camera.png'></label>
                        <input type='file' name='foto' id='foto' onchange='muda($h)'  hidden>
                    </div>
                    <div>
                        <label for='fz'>Fez</label>
                        <input type='radio' name='fz' value='fz'>
                    </div>
                    <div>
                        <label>Não fez</label>
                        <input type='radio' name='fz' value='fnz'>
                    </div>
                    <input type='submit' Value='Ok'>
                </form>
                ";

                $h++;

                $foto = "<img src='$foto' id='fotoAluno'>";

                $div = $div."<div class='aluno'> <p>$nome $sobrenome</p> $feito </div>";
            }
        }
        if(count($valores) == 0){
            $div = "Todos os alunos Já entregaram as atividades";
        }
    }

    $div = $div."</div>";


    //Adicionar entrega de tarefa

    $sim = $img;

    if(isset($_POST['conf'])){
        $id_aluno = $_POST['aluno'];
        $foto = $_FILES['foto'];

        if($_POST['fz'] == "fz"){
            $fez = 'E';
        }else{
            $fez = 'N';
        }




        //Se a foto existir
        if (!empty($foto["name"])){
                
            $nome_imagem = "amogus";
            // Largura máxima em pixels
            $largura = 150000;
            // Altura máxima em pixels
            $altura = 180000;
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

                $a = "aqui";
                
                // Pega extensão da imagem
                preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
        
                // Gera um nome único para a imagem
                $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

                // Caminho de onde ficará a imagem
                $caminho_imagem = "../fotosAtv/fotos/" . $nome_imagem;
                $caminhoImgDireto = "/TCC/settings/Atividade/fotosAtv/fotos/" . $nome_imagem;
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


        $sqlInsert = "insert into entrega (id_atividade, id_aluno, foto, confirmacao, dia_entrega, hora_entrega)
        values ($idAtividade, $id_aluno, '$caminhoImgDireto', '$fez', '".date('Y-d-m')."', '".date('H:i:s')."')";

        mysqli_query($bd, $sqlInsert) or die(mysqli_error($bd)."$idAtividade");

        if ($_FILES['foto']['size'] == 0){
            echo "vazio";
        }

            
            echo "Amogus".date('H:m:s');
    
        header("location:  http://localhost/TCC/visualization/atividades/progresso/addProgressoFront.php?ia=$idAtividade&&it=$idTurma");

    }


    
    
?>

