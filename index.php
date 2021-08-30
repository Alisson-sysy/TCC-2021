<!DOCTYPE html>
<?php 
    include_once("./settings/connections/direct.php");
    if(isset($_GET["error"]) && $_GET["error"] == "1"){
        $text = "<br><p class = 'TextError'>Senha ou Login incorretos</p>";
    }elseif(isset($_GET["error"]) && $_GET["error"] == "2"){
        $text = "<br><p class = 'TextError'>Sessão expirada/Acesso a página sem autorização</p>";
    }else{
        $text = "";
    }
    //  include_once("settings/push/pushDatas.php")

    // define('ROOT_PATH', dirname(__FILE__));

?>

<head>
    <title>E.E.E.Chapeuzinho Vermelho</title>
    <meta charset="UTF-8" />    
</head>

<body>
    <center>
    <form action="settings/connections/login.php" method="POST">

        <label for="login">login</label>
        <input type="text" name="login" id="login" placeholder="Exemplo@gmail.com">
        <br>

        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" placeholder="Digite sua senha aqui">
        <br>

        <input type="submit" value="Login">
        <?php echo $text?>

    </form>
</body>

</html>