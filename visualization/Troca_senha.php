<?php     
    include_once('../settings/connect.php');
    include_once('../settings/functions.php');
    include_once('../settings/check_session.php');
?>


 <!-- Formulário -->
 <li><a href="../settings/exit.php">Sair</a></li>
 <form action="../settings/push/pushDatas.php" method="POST">

<div class="Novo_login">
    <label>Novo Login</label>
    <input type="text" name='login' required>
</div>
<div class='password'>
    <label>Nova senha</label>
    <input type="password" name='password' required>
</div>

<input type="submit" value="Modificar_Login" name="acao">

</form>