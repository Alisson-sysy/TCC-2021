<!-- 
<link rel="stylesheet" href="../CSS/menuImg.css">

    <div class="upImg">
            <h1><a class="sair" id="sair" href="../settings/exit.php">Sair</a></h1>
        <p>PROFIE</p>
        <img src="../img/cabecalhoimg.jpg" class="imgCab" alt="image">
    </div>

    <div class="menu">
        <img src="../img/teste3x4.jpg" class='tresxquatro' alt="image">
        <a class="btn_professor" id="btn_professor" href="../visualization/front_list.php">Professores</a>
        <a href="../visualization/teacherRegister.php">Cadastro de professores</a>
    </div> -->
    <?php
            if(!isset($_SESSION)){
              session_start();
            }
    ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Chapéuzinho Vermelho</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
      <a class="nav-link active" aria-current="page" href="/TCC/visualization/home.php">Home</a>
        <?php
          if ($_SESSION["tipo"] == "D"){
            echo '<a class="nav-link" href="/TCC/visualization/front_list.php">Professores</a>
                  <a class="nav-link" href="/TCC/visualization/teacherRegister.php">Cadastro de professores</a>
                  <a class="nav-link" href="/TCC/visualization/turmas/create">Cadastro de Turmas</a>';
          }
        ?>
        <a class="nav-link" href="/TCC/visualization/planoMensal/list/planoLista.php">Plano mensal</a>
        <a class="nav-link" href="/TCC/visualization/turmas/lista/front_list.php">Lista de Turmas</a>
        <a class="nav-link" href="/TCC/settings/connections/exit.php">Sair</a>
      </div>
    </div>
  </div>
</nav>