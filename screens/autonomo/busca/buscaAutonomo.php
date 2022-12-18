<?php
session_start();
include('../../protect/Protect.php');
include('../../bd_conexao/conexao.php');


$id_prof = $_SESSION['Id_prof'];
$itens_pagina = 2; // quantidade por página
$pagina = 0; //página atual

if(!isset($_GET['busca'])){
    header("Location: ../contratacaoAutonomo.php");
    exit;
}
$nome = "%".trim($_GET['busca'])."%";
$dbh = new PDO('mysql:host=localhost; dbname=streamline', 'root', '');
$sth = $dbh->prepare("SELECT C.Id_cli, C.nome_cli, C.foto_perfil, C.biografia,
C.genero, C.cep, C.estado, C.cidade, A.profissao, A.esp_exp, O.estimativa_preco, C.ativo,
O.data_orcamento FROM orcamento O 
INNER JOIN cadastroprofissional A ON O.Id_prof = A.Id_prof
INNER JOIN cadastrocliente C ON O.Id_cli = C.Id_cli 
WHERE C.ativo = 1 and O.Id_prof = $id_prof and C.nome_cli LIKE :nome LIMIT $pagina, $itens_pagina");

$sth->bindParam(':nome', $nome, PDO::PARAM_STR);
$sth->execute();

$resultados = $sth->fetchAll(PDO::FETCH_ASSOC);

//PAGINAÇÃO
//quantidade de valores no banco de dados
$num_total = $con->query("SELECT C.Id_cli, C.nome_cli, C.foto_perfil, C.biografia,
C.genero, C.cep, C.estado, C.cidade, A.profissao, A.esp_exp, O.estimativa_preco, 
O.data_orcamento FROM orcamento O INNER JOIN cadastroprofissional A ON O.Id_prof = A.Id_prof
INNER JOIN cadastrocliente C ON O.Id_cli = C.Id_cli WHERE O.Id_prof = $id_prof;")->num_rows;
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
  <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.css" />
  <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../../css/bodyContract.css" />
  <link rel="stylesheet" href="../../../css/navbar.css" />
  <link href="../../node_modules/jquery/dist/jquery.js" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
  <script src="../../../node_modules/bootstrap/dist/js/bootstrap.js"></script>
  <script src="../../../node_modules/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="../../../js/function.js"></script>
  <title>Contratação Autônomo</title>
</head>

<body>
  <form action="buscaAutonomo.php" method="GET" name="buscaAutonomo">
  <nav class="navbar navbar-expand-lg bg-faded" style="background-color: #f2f2f2;">
    <div class="container-fluid">
      <a class="navbar-brand">StreamLine</a>
      <button class="navbar-toggler first-button" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <div class="animated-icon1">
          <span></span><span></span><span></span><span></span>
        </div>
      </button>

      <!-- Busca do Autonomo -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
          <form action="">
            <div class="search-box">
              <input type="text" class="search-text" name="busca" id="busca" placeholder="Buscar Nome">
              <a href="javascript:buscaAutonomo.submit()" class="search-btn">
                <img src="../../../img/search.svg" alt="lupa" height="20" width="20" style="margin-right: 5px;">
                <a class="search-txt">Buscar</a>
              </a>
            </div>
          <!-- Fim da busca -->

          <img class="home" src="../../../img/casa.png" alt="home" style="height: 20px; width: 20px; margin-top: 8px" />
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../InicialAutonomoTrabPendentes.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="dadosPessoaisAutonomo.php">Perfil</a>
          </li>
          <img class="user" src="../../../img/user.svg" alt="vertical-line" style="height: 25px; margin-top: 8px;" />
        </ul>
      </div>
    </div>
  </nav>
  </form>

  <!-- Filtro -->
  <form action="../contratacaoAutonomo.php" method="GET" name="filtrobusca">
  <div class="container">
    <div class="accordion-color accordion-flush" id="accordionFlush">
      <div class="accordion-item">
        <a class="accordion collapsed" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne" style="text-decoration: none; color: black; font-family: Arial, Helvetica, sans-serif;">
        <h5 class="accordion-header" id="flush-headingOne" style="padding-left: 2%; padding-top: 2%; padding-bottom: 1%;">
            <img src="../../../img/filter.png" alt="filter" style="height: 40px; width: 40px; margin-right: 1%; cursor: pointer;">Perfis de Clientes
          </h5>
        </a>
        
        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlush">
          <div class="accordion-body">
            <div class="row">
              <div class="col-md-6">
                <h6 style="text-align: left; margin-bottom: 15px">Ordenar Por</h6>
                <center>
                  <div>

                    <label for="dataPublicacao" class="l-radio">
                      <input type="radio" id="dataPublicacao" name="dataPublicacao" value="dataPublicacao" tabindex="5">
                      <span>Data da publicação</span>
                    </label>

                    <label for="avali" class="l-radio">
                      <input type="radio" id="avali" name="avali" value="avali" tabindex="6">
                      <span>Avaliações</span>
                    </label>
                  </div>
                </center>
              </div>
              <div class="col">
                <h6 style="text-align: left; margin-bottom: 15px">Características</h6>
                <center>
                  <div>
                    <label for="estado" class="l-radio">
                      <input type="radio" id="estado" name="estado" value="estado" tabindex="8">
                      <span>Estado</span>
                    </label>

                    <label for="cid" class="l-radio">
                      <input type="radio" id="cid" name="cid" value="cid" tabindex="9">
                      <span>Cidade</span>
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


    <div class="card">
      <div class="card-body">
      <?php
        if(count($resultados)) {
        foreach($resultados as $resultados) { 
          //AVALIAÇÕES
      $id_cli = $resultados['Id_cli'];
      $subconsulta = "SELECT * FROM `avaliacoescliente` where Id_cli = $id_cli;";
      $avaliacoes = $con->query($subconsulta);

      while ($avali = mysqli_fetch_assoc($avaliacoes)) { 
        $id_cli = $avali['Avaliacao_cli'];
        $aval_cli = $avali['Avaliacao_cli'];
        
        $aval_contagem = count((array)$aval_cli);
        $soma_avaliacao = array_sum((array)$aval_cli);
        $aval_valor = $soma_avaliacao/$aval_contagem;
      }
        
          ?>
          <form method="post" action="../AutonomoAceitarServico.php" id="form" name="form">
            <div class="row">
              <div class="col">
                <div class="estrelas">
                <label for="cm_star-1"><?php echo substr($aval_valor,0,3); ?>  <i class="fa"></i></label>
                </div>
                <center>
                  <img src="<?php echo '../../cliente/perfil/' . $resultados['foto_perfil']; ?>" class="img-fluid" alt="user" 
                  style="width: 150px; height: 150px; object-fit: cover; background: #182B3D; margin-top: 3%; margin-bottom: 5%; border-radius: 10px;">
                </center>
              </div>
              <div class="col-md-4" id="infocima">
                <div class="form-group">
                  <label class="label" for="Prof">Profissão Requisitada:</label>
                  <input type="text" class="form-control" required name="Prof" id="Prof" value="<?php echo $resultados['profissao']; ?>" disabled />
                </div>
                <div class="form-group">
                  <label class="label" for="Nome">Nome:</label>
                  <input type="text" class="form-control" required name="Nome" id="Nome" value="<?php echo $resultados['nome_cli']; ?>" disabled />
                </div>
              </div>
              <div class="col-md-4" id="infocima">
                <div class="form-group">
                  <label class="label" for="Preco">Preço:</label>
                  <input type="text" class="form-control" required name="Preco" id="Preco" value="<?php echo $resultados['estimativa_preco']; ?>" disabled />
                </div>
                <div class="form-group">
                  <label class="label" for="Gênero">Gênero:</label>
                  <input type="text" class="form-control" required name="Gênero" id="Gênero" value="<?php echo $resultados['genero']; ?>" disabled />
                </div>
              </div>
              <div class="form-group">
                <label class="label" for="Esp">Especialidade:</label>
                <input type="text" class="form-control" required name="Esp" id="Esp" value="<?php echo $resultados['esp_exp']; ?>" disabled />
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label class="label" for="DataPedido">Data do Pedido:</label>
                  <input class="form-control" required name="DataPedido" id="DataPedido" value="<?php $data = $resultados['data_orcamento'];
                                                                                                echo date_format(new DateTime($data), 'd/m/Y'); ?>" disabled />
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="label" for="Cidade">Cidade:</label>
                  <input type="text" class="form-control" required name="Cidade" id="Cidade" value="<?php echo $resultados['cidade']; ?>" disabled />
                </div>
              </div>
              <div class="col-md-3" style="padding-top: 2.2px;">
                <div class="form-group">
                  <label class="label" for="UF">Estado:</label>
                  <input type="text" class="form-control" required name="UF" id="UF" value="<?php echo $resultados['estado'];; ?>" disabled />
                </div>
              </div>
              <div class="col-md-12" style="padding-top: 4%; margin-bottom: 10px;">
                <div class="form-group1">
                  <label class="label" for="Biografia">Biografia:</label>
                  <textarea class="form-control" id="Biografia" disabled rows="3"><?php echo $resultados['biografia']; ?></textarea>
                </div>
                <input type="hidden" class="form-control" name="cliente" id="cliente" value="<?php echo $resultados['Id_cli']; ?>" />
              </div>
            </div>
            <div class="buttons">
              <button type="submit" id="btnEntrar" class="btnEntrar">
                Descartar
              </button>
              <button type="submit" id="btnPress" class="btnPress">
                Ver Mais
              </button>
            </div>
          </form>
          <br>
          <br>
          <?php
        }
      }else{ ?>
        <!-- ** PRECISA ESTILIZAR -->
        <h3>Nenhum Resultado foi encontrado!</h3> 
     <?php } ?>
      </div>
    </div>

    <div class="page-content page-container" id="page-content">
      <div class="padding">
        <div class="row container-row d-flex justify-content-center">
          <div class="col-md-5 col-sm-6 grid-margin stretch-card">
            <nav>
              <ul class="pagination d-flex justify-content-center flex-wrap pagination-rounded-flat pagination-success">
                <li class="page-item"><a class="page-link" href="buscaAutonomo.php?pagina=0" data-abc="true"><i class="fa fa-angle-left"></i></a>
                </li>
                <!-- numeração -->
                <?php
                for ($i = 0; $i < $num_paginas; $i++) {
                  $estilo = "";
                  if ($pagina == $i) {
                    $estilo = "class=\"page-item active\"";
                ?>
                    <li class="page-item active"><a class="page-link" href="buscaAutonomo.php?pagina=<?php echo $i; ?>" data-abc="true"><?php echo $i + 1; ?></a></li>

                    <!-- Fim da numeração -->
                    <li class="page-item"><a class="page-link" href="buscaAutonomo.php?pagina=<?php echo $num_paginas - 1; ?>" data-abc="true"><i class="fa fa-angle-right"></i></a></li>
                  <?php } ?>
                <?php } ?>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>