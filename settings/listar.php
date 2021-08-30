<?php
	//Conexão ao banco de dados
	$dbc = mysqli_connect('localhost', 'root', '', 'agenda') or die ('Erro ao conectar ao servidor MySQL'); 
	//instrução a ser executada no banco de dados
	$query = "SELECT id, nome, sobrenome, telefone, email, foto FROM contato";
	//execução da instrução no banco de dados
	$result = mysqli_query($dbc, $query) or die ('Erro ao executar o comando SQL');
    echo '<h2> Listar Contatos</h2>';
	//exibe os dados em uma tabela
	echo '<table border=1>';
	echo '<tr><td>Id</td><td>Nome</td><td>Sobrenome</td><td>Telefone</td><td>E-mail</td><td>Foto do contato</td><td>Opcoes</td></tr>';
	while ($row = mysqli_fetch_array($result)) { 
        // Display the score data
        echo '<tr><td>' . $row['id'] . '</td>';
        echo '<td>' . $row['nome'] . '</td>';
        echo '<td>' . $row['sobrenome'] . '</td>';
        echo '<td>' . $row['telefone'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo "<td><img src='fotos/".$row['foto']."' alt='Foto de exibição' /><br />";" </td>";

        echo '<td><a href="altera.php?id=' . $row['id'].'">Alterar</a> <a href="remove.php?id=' . $row['id'].'">Remover</a></td></tr>';
    }
    echo '</table>';
    echo '<a href="index.php">Voltar</a>';
?>