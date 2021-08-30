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
    }
    
    $sql = "SELECT * FROM plano_mensal order by month(data)";
    $result = mysqli_query($bd, $sql) or die(mysqli_error($bd));
    

    if(mysqli_num_rows($result) > 0){
        $div = "<div class='listaPlano'>";

        while($dados = mysqli_fetch_assoc($result)){
            $id = $dados["id_plano"];
            $tt = $dados["tt_plano"];
            $data = $dados["data"];

            $div = $div."<h1>$tt</h1>";
            $div = $div."<p>Data de postagem do plano: $data</p>";

            $sqlTop = "SELECT * FROM topico_plano where id_plano = $id";
            $resultado = mysqli_query($bd, $sqlTop) or die(mysqli_error($bd));

            while($dado = mysqli_fetch_assoc($resultado)){
                $ttTopico = $dado["topico"];
                $cttTopico = $dado["ctt_topico"];           

                $div = $div."<h3>$ttTopico</h3>";
                $div = $div."<p>$cttTopico</p>";
            }

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
            }

            $div = $div."$infoPlano $addTop $excluir";

        }
        $div = $div."</div>";
    }else{
        $div = "Não há registros";
    }

    
?>

<script>
    function confirma(caminho){  
        alert("Apagar um Aluno? Tem certeza sobre isso?");
        confirm = confirm('Se você apagar esse aluno(a), todas as obervações e informações pessoais do mesmo serão apagadas, permanentemente!!!');
        if(confirm){
            window.location.href = "/TCC/settings/planoMensal/list/backList.php?id="+caminho;
        }else{
            window.location.href = "/TCC/visualization/alunos/lista/front_list.php";
        }   
    }
</script>