<?php
    //captura o id repassado pela URL
    $id = $_GET['id'];
    //Conexão ao banco de dados
	$dbc = mysqli_connect('localhost', 'root', '', 'agenda') or die ('Erro ao conectar ao servidor MySQL'); 
	//instrução a ser executada no banco de dados
	$query = "DELETE FROM contato WHERE id='$id' LIMIT 1";
	//execução da instrução no banco de dados
	$result = mysqli_query($dbc, $query) or die ('Erro ao executar o comando SQL');
	echo '<p>O registro '. $id . ' Foi removido com sucesso!';
	//encerra a conexao com o banco
    mysqli_close($dbc);
    //retorna a pagina anterior após 5 segundos
	echo '<meta http-equiv="refresh" content="1;URL=listar.php" />';
?>
