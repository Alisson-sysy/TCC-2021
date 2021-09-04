<?php 
    include_once("./settings/connections/direct.php");
    if(isset($_GET["error"]) && $_GET["error"] == "1"){
        $text = "<br><p class = 'TextError'><b>CUIDADO!<b> Senha ou Login incorretos</p>";
    }elseif(isset($_GET["error"]) && $_GET["error"] == "2"){
        $text = "<br><p class = 'TextError'>Sessão expirada/Acesso a página sem autorização</p>";
    }else{
        $text = "";
    }

?>
<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <title>E.E.E.Chapeuzinho Vermelho</title>
        <meta charset="UTF-8" />   
        <link rel="stylesheet" href="/TCC/CSS/login/cssIndex.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Londrina+Sketch&family=Poppins:wght@100&display=swap" rel="stylesheet">
    </head>

    <body>
        <center>
        <main class="mainCount">

            <div class="infoSis">
                <div class="imgLogo">
                    <img src="/TCC/CSS/imgCss/Logo.png" alt="" class="logoIm">
                </div>
                <div class="textLogo">
                    <p class="logoTittle">Profie</p>
                    <p class='logoTetx'>Seu sistema</p>
                    <p class='logoTetx'>de organização</p>
                </div>
            </div>

            <div class="inputs">
                <form action="settings/connections/login.php" method="POST">

                    <input type="text" name="login" class='inputLogin' id="login" placeholder="Digite seu Login aqui">
                    <br>

                    <input type="password" name="password" class='inputLogin' id="password"  placeholder="Digite sua senha aqui">
                    <br>

                    <input type="submit" class='submitButton' class='Modificar_Login' value="Login">
                    <?php echo $text?>
                </form>
            </div>
            
        </main>
    </body>

</html>

