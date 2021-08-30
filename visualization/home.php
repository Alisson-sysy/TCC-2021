<?php include_once("../settings/connections/check_session.php");?>
<?php include_once("../settings/lembretes/list/lista.php");?>
<?php 
    $newLembrete = "";
    if(isset($_POST["new"])){
        if($_POST["new"] === "Novo Lembrete"){
            $newLembrete = '<form action="../settings/lembretes/push/pushLembretes.php" method="POST">
                                <input type="text" name="lembreteText" value="" required>
                                <input type="submit" name="add" value="Adicionar lembrete">
                            </form>';
        }
    }

?>
<!DOCTYPE html>
    <head>
        <title>Home page</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../CSS/home_css.css">
    </head>
    <body>

        <div class="cabecalho" id="cabecalho">
            <?php include_once("menu.php");?>
        </div>

        <?php
        
            if( $_SESSION["tipo"] == "D"){
                $text_page = "Olá ". $_SESSION["nome"];
            }else{
                $text_page = "Olá ". $_SESSION["nome"];
            }

            echo "<h1>".$text_page."</h1>";
        ?>
        <h3>Lembretes</h3>
        <div class="lembrete">
            <?php echo $table?>
            <form action="" method="POST">
                <input type="submit" name="new" value="Novo Lembrete">
            </form>
        </div>
        <?php echo $newLembrete?>

    </body>
</html>