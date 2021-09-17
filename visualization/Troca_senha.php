<?php     
    include_once('../settings/connections/connect.php');
    include_once('../settings/functions.php');
    include_once('../settings/connections/check_session.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/TCC/CSS/login/mudaLogin.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Londrina+Sketch&family=Poppins:wght@100&display=swap" rel="stylesheet">
        <title>Document</title>
    </head>
    <body>
        <center>
         <!-- Formulário -->
        <main class="mainCount">
            <div class="textLogo">
                <p class="logoTittle">Profie</p>
                <p class="logoTetx">
                    Para começarmos a utilização do sistema,
                </p>
                <p class="logoTetx">
                    é preciso que você insira suas novas informações de login!
                </p>
            </div>

            <form action="../settings/push/pushDatas.php" class='form' method="POST">
                    <div class="Novo_login">
                        <input type="text" name='login' class='inputLogin'  placeholder='Seu novo login' required>
                    </div>

                    <div class='password'>
                        <input type="password" name='password' class='inputLogin' placeholder='Sua nova senha' required>
                    </div>

                    <input type="hidden" name="acao" value='Modificar_Login'>
                    <input type="submit" class="submitButton"  value="Pronto" >
            </form>
        </main>
    </body>
</html>