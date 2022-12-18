<?php
session_start();
include('../bd_conexao/conexao.php');
include('../protect/ProtectAdm.php'); // inicia a sessão do adm e protege o login

$itens_pagina = 25; // quantidade por página
$pagina = 0; //página atual

// FILTRO
$dados = filter_input_array(INPUT_GET, FILTER_DEFAULT);

if(!empty($dados['autonomo'])){
  $cons = "SELECT * FROM `cadastroprofissional` WHERE not Id_prof = '1' ORDER BY `cadastroprofissional`.`data_cadProf` DESC LIMIT $pagina, $itens_pagina;";
  $consulta = $con->query($cons);

}
elseif(!empty($dados['cliente'])){ 
  $cons = "SELECT * FROM `cadastrocliente` WHERE not Id_cli = '1' ORDER BY  `cadastrocliente`.`Data_cadCli` DESC LIMIT $pagina, $itens_pagina;";
  $consulta = $con->query($cons);
}
elseif(!empty($dados['denunciaAuto'])){ 
  $cons = "SELECT * FROM `denuncia_prof` LIMIT $pagina, $itens_pagina;";
  $consulta = $con->query($cons);

}elseif(!empty($dados['denunciaCli'])){ 
  $cons = "SELECT * FROM `denuncia_cli` LIMIT $pagina, $itens_pagina;";
  $consulta = $con->query($cons);
}
else{
  //CONSULTA BANCO SEM FILTRO
  $cons = "SELECT * FROM `cadastroprofissional` ORDER BY `cadastroprofissional`.`data_cadProf` LIMIT $pagina, $itens_pagina;";
 $consulta = $con->query($cons);
  }
  $con_rows = $consulta ->num_rows;

//FIM FILTRO

//PAGINAÇÃO
//quantidade de valores no banco de dados
$num_total = $con->query("SELECT * FROM `cadastroprofissional` ORDER BY `cadastroprofissional`.`data_cadProf`;")->num_rows;
$num_paginas = ceil($num_total / $itens_pagina);
//FIM PAGINAÇÃO
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="format-detection" content="telephone=no" />
  <meta name="msapplication-tap-highlight" content="no" />
  <meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover" />
  <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.css" />
  <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../css/bodyContract.css" />
  <link rel="stylesheet" href="../../css/navbar.css" />
  <link href="../../node_modules/jquery/dist/jquery.js" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
  <script src="../../node_modules/bootstrap/dist/js/bootstrap.js"></script>
  <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="../../js/function.js"></script>
  <title>Administrador</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-faded" style="background-color: #f2f2f2;">
    <div class="container-fluid">
      <a class="navbar-brand">StreamLine</a>
      <button class="navbar-toggler first-button" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <div class="animated-icon1">
          <span></span><span></span><span></span><span></span>
        </div>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
          <div class="search-box">
            <input type="text" class="search-text" placeholder="Buscar">
            <a href="#" class="search-btn">
              <img src="../../img/search.svg" alt="lupa" height="20" width="20" style="margin-right: 5px;">
              <a class="search-txt">Buscar</a>
            </a>
          </div>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Filtro -->
  <form action="telaAdm.php" method="GET" name="filtrobusca">
  <div class="container">
    <div class="accordion-color accordion-flush" id="accordionFlush">
      <div class="accordion-item">
        <a class="accordion collapsed" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne" style="text-decoration: none; color: black; font-family: Arial, Helvetica, sans-serif;">
        <h5 class="accordion-header" id="flush-headingOne" style="padding-left: 2%; padding-top: 2%; padding-bottom: 1%;">
            <img src="../../img/filter.png" alt="filter" style="height: 40px; width: 40px; margin-right: 1%; cursor: pointer;">Filtre para Consultar
          </h5>
        </a>
        
        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlush">
          <div class="accordion-body">
            <div class="row">
              <div class="col-md-6">
                <h6 style="text-align: left; margin-bottom: 15px">Registros</h6>
                <center>
                  <div>

                    <label for="autonomo" class="l-radio">
                      <input type="radio" id="autonomo" name="autonomo" value="autonomo" tabindex="5">
                      <span>Autônomo</span>
                    </label>

                    <label for="cliente" class="l-radio">
                      <input type="radio" id="cliente" name="cliente" value="cliente" tabindex="6">
                      <span>Cliente</span>
                    </label>
                  </div>
                </center>
              </div>
              <div class="col">
                <h6 style="text-align: left; margin-bottom: 15px">Denúncias</h6>
                <center>
                  <div>
                    <label for="denunciaAuto" class="l-radio">
                      <input type="radio" id="denunciaAuto" name="denunciaAuto" value="denunciaAuto" tabindex="8">
                      <span>Autônomo</span>
                    </label>

                    <label for="denunciaCli" class="l-radio">
                      <input type="radio" id="denunciaCli" name="denunciaCli" value="denunciaCli" tabindex="9">
                      <span>Cliente</span>
                    </label>
                  </div>
                </center>
                <button type="submit" value="filtro" name="filtro"
                          style="text-align: center; margin: 10px; padding: 10px"
                          class='btn pull-right'>Filtrar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </form>
  <!-- FIM DO FILTRO -->
  <br>
  <br>
    <center>
    <?php
     if(!empty($dados['autonomo'])){
      $cons = "SELECT * FROM `cadastroprofissional` ORDER BY `cadastroprofissional`.`data_cadProf` DESC LIMIT $pagina, $itens_pagina;";
      $consulta = $con->query($cons); ?>
      <form method="GET">
      <div class="table-responsive">
            <table class="table table-hover table table-bordered" >
            <caption>Profissionais</caption>
            <thead class="table-dark">
              <tr class="align-bottom">
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">Profissão</th>
                <th scope="col">E-mail</th>
                <th scope="col">Contato</th>
                <th scope="col">Ativo</th>
                <th scope="col">   </th>
              </tr>
            </thead>
            <tbody>
              <?php
                  while($dados = mysqli_fetch_assoc($consulta)){
                      echo "<tr>";
                      echo "<td>".$dados['Id_prof'];
                      echo "<td>".$dados['nome_prof'];
                      echo "<td>".$dados['profissao'];
                      echo "<td>".$dados['email_prof'];
                      echo "<td>".$dados['contato'];
                      echo "<td>".$dados['ativo'];
                      echo "<td> 
                        <a class='btn btn-primary' href='editarAuto.php?id=$dados[Id_prof]'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pen' viewBox='0 0 16 16'>
                      <path d='m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z'/>
                        </svg>
                       </a></td>";
                      
                      echo "<tr>";
                  }
              ?>
            </tbody>
          </table>
      </div>
      </form>
      </center>
      <br>
      <br>
      <?php }?>

      <center>
    <?php
     if(!empty($dados['cliente'])){ 
      $cons = "SELECT * FROM `cadastrocliente` ORDER BY `cadastrocliente`.`Data_cadCli` DESC LIMIT $pagina, $itens_pagina;";
      $consulta = $con->query($cons); ?>
      <div class="table-responsive">
            <table class="table table-hover table table-bordered">
            <caption>Clientes</caption>
            <thead class="table-dark">
              <tr >
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">Contato</th>
                <th scope="col">Ativo</th>
                <th scope="col">   </th>
              </tr>
            </thead>
            <tbody>
              <?php
                  while($dados = mysqli_fetch_assoc($consulta)){
                    echo "<tr>";
                    echo "<td>".$dados['Id_cli'];
                    echo "<td>".$dados['nome_cli'];
                    echo "<td>".$dados['email_cli'];
                    echo "<td>".$dados['contato'];
                    echo "<td>".$dados['ativo'];
                    echo "<td> 
                        <a class='btn btn-primary' href='editarCli.php?id=$dados[Id_cli]'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pen' viewBox='0 0 16 16'>
                      <path d='m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z'/>
                        </svg>
                       </a></td>";
                    echo "<tr>";
                  }
              ?>
            </tbody>
          </table>
      </div>
      </center>
      <br>
      <br>
      <?php } ?>
      

      <?php
      if(!empty($dados['denunciaAuto'])){ 
        $cons = "SELECT * FROM `denuncia_prof` LIMIT $pagina, $itens_pagina;";
        $consulta = $con->query($cons); ?>
      <div class="table-responsive">
            <table class="table table-hover table table-bordered">
            <caption>Profissionais Denunciados</caption>
            <thead class="table-dark">
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Denúncia</th>
                <th scope="col">Reclamação</th>
                <th scope="col">Ativo</th>
                <th scope="col">   </th>
              </tr>
            </thead>
            <tbody>
              <?php
                  while($dados = mysqli_fetch_assoc($consulta)){
                    echo "<tr>";
                    echo "<td>".$dados['Id_prof'];
                    echo "<td>".$dados['motivo'];
                    echo "<td>".$dados['reclamacao'];
                    echo "<td>".$dados['ativo'];
                    echo "<td> 
                        <a class='btn btn-primary' href='editarAuto.php?id=$dados[Id_prof]'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pen' viewBox='0 0 16 16'>
                      <path d='m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z'/>
                        </svg>
                       </a></td>";
                    echo "<tr>";
                  }
              ?>
            </tbody>
          </table>
      </div>
      </center>
      <br>
      <br>
      <?php }
       ?>

<?php
      if(!empty($dados['denunciaCli'])){ 
        $cons = "SELECT * FROM `denuncia_cli` LIMIT $pagina, $itens_pagina;";
        $consulta = $con->query($cons);?>
      <div class="table-responsive">
            <table class="table table-hover table table-bordered">
            <caption>Clientes Denunciados</caption>
            <thead class="table-dark">
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Denúncia</th>
                <th scope="col">Reclamação</th>
                <th scope="col">Ativo</th>
                <th scope="col">   </th>
              </tr>
            </thead>
            <tbody>
              <?php
                  while($dados = mysqli_fetch_assoc($consulta)){
                    echo "<tr>";
                    echo "<td>".$dados['Id_cli'];
                    echo "<td>".$dados['motivo'];
                    echo "<td>".$dados['reclamacao'];
                    echo "<td>".$dados['ativo'];
                    echo "<td> 
                        <a class='btn btn-primary' href='editarCli.php?id=$dados[Id_cli]'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pen' viewBox='0 0 16 16'>
                      <path d='m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z'/>
                        </svg>
                       </a></td>";
                    echo "<tr>";
                  }
              ?>
            </tbody>
          </table>
      </div>
      </center>
      <br>
      <br>
      <?php }
       ?>
      

    <!-- PAGINAÇÃO -->
    <div class="page-content page-container" id="page-content">
      <div class="padding">
        <div class="row container-row d-flex justify-content-center">
          <div class="col-md-5 col-sm-6 grid-margin stretch-card">
            <nav>
              <ul class="pagination d-flex justify-content-center flex-wrap pagination-rounded-flat pagination-success">
                <li class="page-item"><a class="page-link" href="anual.php?pagina=0" data-abc="true"><i class="fa fa-angle-left"></i></a>
                </li>
                <!-- numeração -->
                 <?php 
                for($i=0;$i<$num_paginas;$i++){ 
                  $estilo = "";
                  if($pagina == $i){
                    $estilo = "class=\"page-item active\"";
                  ?>
                <li class="page-item active" ><a class="page-link" href="anual.php?pagina=<?php echo $i; ?>" data-abc="true"><?php echo $i+1; ?></a></li>
                <?php } ?>
                <?php } ?>
              <!-- Fim da numeração -->
                <li class="page-item"><a class="page-link" href="anual.php?pagina=<?php echo $num_paginas-1; ?>" data-abc="true"><i
                      class="fa fa-angle-right"></i></a></li>
            </nav>
          </div>
        </div>
      </div>
    </div>
      <!-- FIM PAGINAÇÃO -->
</body>

</html>
