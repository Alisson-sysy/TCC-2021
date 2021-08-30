<?php
// Conexão com o banco de dados
// $dbc = @mysqli_connect('localhost', 'root', '','agenda') or die ("Problemas na conexão.");
//$db = @mysql_select_db("banco", $conn) or die ("Problemas na conexão");
 
// Se o usuário clicou no botão cadastrar efetua as ações
if (isset($_POST['cadastrar'])) {
	
	// Recupera os dados dos campos
	$nome = $_POST['nome'];
 	$sobrenome = $_POST['sobrenome'];
	$telefone = $_POST['telefone'];  
	$email = $_POST['email'];
	$foto = $_FILES["foto"];
	
	// Se a foto estiver sido selecionada
	if (!empty($foto["name"])) {
		
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
        	$caminho_imagem = "fotos/" . $nome_imagem;
 
			// Faz o upload da imagem para seu respectivo caminho
			move_uploaded_file($foto["tmp_name"], $caminho_imagem);
			
			
			// Insere os dados no banco
			$query = "INSERT INTO contato (nome, sobrenome, telefone, email, foto) VALUES ('$nome', '$sobrenome', '$telefone', '$email','$nome_imagem')";
            
            $result = mysqli_query($dbc, $query) or die ('Erro ao executar o comando SQL');

		
			// Se os dados forem inseridos com sucesso
			if ($result){
				echo "Você foi cadastrado com sucesso.";
                echo '<meta http-equiv="refresh" content="5;URL=listar.php" />';

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