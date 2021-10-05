<?php 

    $path = dirname(__FILE__) . '/../../connections/connect.php';
    include_once($path);


    if(!isset($_SESSION)){
        session_start();
    }

    $infoPlano = "";
    $addTop = "";
    $excluir = "";

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $sql = "DELETE from plano_mensal where id_plano = $id";

        mysqli_query($bd, $sql) or die(mysqli_error($bd));

        header("location: /TCC/visualization/planoMensal/list/planoLista.php");
    }
    
    $sql = "SELECT * FROM plano_mensal order by month(data)";
    $result = mysqli_query($bd, $sql) or die(mysqli_error($bd));

    if(mysqli_num_rows($result) > 0){
        $div = "<div class='listaPlano'>";

        while($dados = mysqli_fetch_assoc($result)){
            $div = $div."<div class='plano'>";
            $id = $dados["id_plano"];
            $tt = $dados["tt_plano"];
            $data = $dados["data"];
            $h = 0;
            

            $div = $div."<h1>$tt</h1>";
            $div = $div."<p id='data'>Data: $data</p>";

            $sqlTop = "SELECT * FROM topico_plano where id_plano = $id";
            $resultado = mysqli_query($bd, $sqlTop) or die(mysqli_error($bd));
            $div = $div."<div class='topicos' >";

                while($dado = mysqli_fetch_assoc($resultado)){
                    if($h >=2){
                        $h = 0;
                    }
            
                    $ttTopico = $dado["topico"];
                    $cttTopico = $dado["ctt_topico"];   
                    $idTopic = $dado['id_topico'];      
                    
                    $div = $div."<div class='topico' id='topico$h'>";
                    $div = $div."<div class='barrinha$h' id='barrinha'></div>";
                    $div = $div."<p id='ttTopico'>$ttTopico</p>";
                    $div = $div."<p id='cttTopico'>$cttTopico</p>";
                    if($_SESSION['tipo'] == "D"){
                        $div = $div."<form action='http://localhost/TCC/visualization/planoMensal/createPlano/createPlano.php' method='POST'>
                                    <input type='hidden' name='idTopic' value='$idTopic'>
                                    <input type='submit' name='editarTopico' id='btnEditar' value='Editar'>
                                 </form>";
                    $div = $div."</div>";
                    }
                    $h++;
                }
            $div = $div."</div>";
            if($_SESSION["tipo"] == "D"){
                $infoPlano = "<form action='/TCC/visualization/planoMensal/createPlano/createPlano.php' method='POST'>
                    <input type='hidden' name='valor' value='$id'>
                    <input type='submit' name='editar' value='editar'>
                </form>";
                
                $addTop = "<form action='/TCC/visualization/planoMensal/createPlano/createPlano.php' method='POST'>
                    <input type='hidden' name='valor' value='$id'>
                    <input type='submit' name='AdicionarTópico' value='Adicionar Tópico'>
                </form>";

                $excluir = "<input type='button' name='acao' value='excluir' onclick='confirma($id)'>";

                $div = $div."<div class='btn'>$addTop $infoPlano $excluir</div>";
            }
            $div = $div."</div>";

        }
        $div = $div."</div>";
    }else{
        $div = "Não há registros";
    }

    
?>

<script>
    function confirma(caminho){  
        confirm1 = confirm("Apagar um Plano mensal? Tem certeza sobre isso?");
        if(confirm1 == true){
            confirm = confirm('Se você apagar esse plano, todas as informações contidas neles serão apagadas permanentemente!');
            if(confirm && confirm1){
            window.location.href = "/TCC/settings/planoMensal/list/backList.php?id="+caminho;
            }else{
                window.location.href = "http://localhost/TCC/visualization/planoMensal/list/planoLista.php";
            } 
        }else{
            window.location.href = "http://localhost/TCC/visualization/planoMensal/list/planoLista.php";
        }
    }
</script>