<?php
session_start();
include('../protect/Protect.php');
include('../bd_conexao/conexao.php');


$id_prof = $_SESSION['Id_prof'];
$itens_pagina = 1; // quantidade por página
$pagina = 0; //página atual
$itens_carousel = 1;

//Consulta trabalhos pendentes
$cons = "SELECT C.Id_cli, C.nome_cli, C.genero, C.estado, C.cidade, C.foto_perfil, C.biografia, 
A.profissao, A.esp_exp, S.preco_final, S.data_contratacao FROM servico S 
INNER JOIN cadastroprofissional A ON S.Id_prof = A.Id_prof 
INNER JOIN cadastrocliente C ON S.Id_cli = C.Id_cli 
INNER JOIN avaliacoescliente E ON S.Id_cli = E.Id_cli
WHERE S.data_finalizacao = 0 and S.Id_prof = $id_prof LIMIT $pagina, $itens_pagina;";
$consulta = $con->query($cons);
//Fim da Consulta trabalhos pendentes

//AS AVALIAÇÕES PENDENTES
$aval = "SELECT C.nome_cli,C.foto_perfil, C.Id_cli, A.profissao, A.esp_exp, A.nome_prof, V.Avaliacao_cli
FROM avaliacoescliente V 
INNER JOIN cadastroprofissional A ON A.Id_prof = V.Id_prof 
INNER JOIN cadastrocliente C ON C.Id_cli = V.Id_cli 
WHERE V.data_aval_cli = 0 and V.Comentario_cli = 0 and V.Avaliacao_cli = 0 and V.Id_prof = $id_prof LIMIT $pagina, $itens_pagina;";
$avaliacoes = $con->query($aval);
//FIM DAS AVALIAÇÕES PENDENTES

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="format-detection" content="telephone=no" />
  <meta name="msapplication-tap-highlight" content="no" />
  <meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover" />

  <link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" href="../../css/trabalhos.css" />
  <link rel="stylesheet" href="../../css/navbarHome.css" />
  <script src="../../js/jquery.js"></script>
  <script src="../../bootstrap/js/bootstrap.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" />
  <script type="text/javascript" src="../../js/function.js"></script>
  <title>Home</title>
</head>


<body>
  <nav class="navbar navbar-expand-lg bg-faded" style="background-color: #f2f2f2">
    <div class="container-fluid">
      <a href="InicialAutonomoTrabPendentes.php" class="navbar-brand">StreamLine</a>
      <button class="navbar-toggler first-button" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <div class="animated-icon1">
          <span></span><span></span><span></span><span></span>
        </div>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item dropdown">
            <a class="nav-link active dropdown-toggle" id="navbarDropdown">
              Trabalhos
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <div class="dropdown-divider" style="width: 60%; background-color: black"></div>
              <li><a class="dropdown-item" href="TrabalhosRealizados.php">Finalizados</a></li>
              <li><a class="dropdown-item" href="TrabalhosPendentes.php">Pendentes</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <?php
  if ($avaliacoes->num_rows > 0) {
    while ($aval = mysqli_fetch_assoc($avaliacoes)) {
      //AVALIAÇÕES
      $id_cli = $aval['Id_cli'];
      $subconsul = "SELECT AVG(DISTINCT Avaliacao_cli) as AvaliacaoCli FROM avaliacoescliente where Id_cli = $id_cli;";
      $av = $con->query($subconsul);

      while ($avali = mysqli_fetch_assoc($av)) { 

        $aval_values = $avali['AvaliacaoCli'];
      }
  ?>
      <!-- Avaliação Pendente -->
      <div class="container container-fluid" style="background-color: #f2f2f2; padding-top: 3.5%; min-height: 800px">
        <div class="col-sm-5" style="margin-bottom: 5%;">
          <h3 style="
          font-weight: bold;
          margin: 0;
          text-align: center;
        ">
            Avaliação Pendente
          </h3>
          <h5 style="text-align: center;margin-top: 5%;">
            Avalie o cliente para navegar
          </h5>
        </div>
        <div class="card">
          <div class="card-body">

            <form method="post" action="AvaliacaoCliente.php" id="form" name="form">
              <div class="row">
                <div class="col">
                  <div class="estrelas">
                    <label for="cm_star-1"><?php echo substr($aval_values, 0, 3); ?> <i class="fa"></i></label>
                  </div>
                  <center>
                    <img src="<?php echo '../cliente/perfil/' . $aval['foto_perfil'] ?>" class="img-fluid" alt="user" style="
                      width: 150px; height: 150px; object-fit: cover;
                      background: #182b3d;
                      margin-top: 3%;
                      margin-bottom: 5%;
                      border-radius: 10px;
                    " />
                  </center>
                </div>
                <div class="form-group">
                  <label class="label" for="Prof" style="margin-left: 3%">Profissão Requisitada:</label>
                  <input type="text" class="form-control" required name="Prof" id="Prof" value="<?php echo $aval['profissao']; ?>" disabled />
                </div>
                <div class="form-group">
                  <label class="label" for="Nome" style="margin-left: 3%">Nome:</label>
                  <input type="text" class="form-control" required name="nomecli" id="nomecli" value="<?php echo $aval['nome_cli']; ?>" disabled />
                </div>
                <div class="form-group">
                  <label class="label" for="Esp" style="margin-left: 3%">Especialidade:</label>
                  <input type="text" class="form-control" required name="Esp" id="Esp" value="<?php echo $aval['esp_exp']; ?>" disabled />
                </div>
                <input type="hidden" class="form-control" name="cli" id="cliente" value="<?php echo $aval['Id_cli']; ?>" />
                <input type="hidden" class="form-control" name="nome_prof" id="nome_prof" value="<?php echo $aval['nome_prof']; ?>" />
              </div>
              <div class="buttons">
                <button type="submit" formaction="DenunciarCliente.php" id="btnEntrar" class="btnEntrar">
                  Denunciar
                </button>
                <button type="submit" id="btnPress" class="btnPress">
                  Avaliar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
  <?php }
  }
  ?>
  <!-- FIM DA AVALIAÇÃO PENDENTE -->

  <div class="container container-fluid" style="background-color: #f2f2f2; padding-top: 3.5%; min-height: 800px">
    <div class="col-sm-5" style="margin-bottom: 5%;">
      <h2 style="
          font-weight: bold;
          margin: 0;
          text-align: center;
        ">
        Clientes Pendentes
      </h2>
      <h5 style="text-align: center;margin-top: 5%;">
        Clientes com serviço não finalizado
      </h5>
    </div>
    <div class="card">
      <div class="card-body">
        <?php
        if ($consulta->num_rows > 0) {
          while ($dado = mysqli_fetch_assoc($consulta)) {
            //AVALIAÇÕES
      $id_cli = $dado['Id_cli'];
      $subconsulta = "SELECT AVG(DISTINCT Avaliacao_cli) as AvaliacaoCli FROM avaliacoescliente where Id_cli = $id_cli;";
      $avaliacoes = $con->query($subconsulta);

      while ($avali = mysqli_fetch_assoc($avaliacoes)) { 

        $aval_valor = $avali['AvaliacaoCli'];
      }
        ?>
            <form method="post" action="AutonomoFinalizarServico.php" id="form" name="form">
              <div class="row">
                <div class="col">
                  <div class="estrelas">
                    <label for="cm_star-1"><?php echo substr($aval_valor, 0, 3); ?> <i class="fa"></i></label>
                  </div>
                  <center>
                    <img src="<?php echo '../cliente/perfil/' . $dado['foto_perfil'] ?>" class="img-fluid" alt="user" style="
                      width: 150px; height: 150px; object-fit: cover;
                      background: #182b3d;
                      margin-top: 3%;
                      margin-bottom: 5%;
                      border-radius: 10px;
                    " />
                  </center>
                </div>
                <div class="col-md-4" id="infocima">
                  <div class="form-group">
                    <label class="label" for="Prof" style="margin-left: 3%">Profissão Requisitada:</label>
                    <input type="text" class="form-control" required name="Prof" id="Prof" value="<?php echo $dado['profissao']; ?>" disabled />
                  </div>
                  <div class="form-group">
                    <label class="label" for="Nome" style="margin-left: 3%">Nome:</label>
                    <input type="text" class="form-control" required name="Nome" id="Nome" value="<?php echo $dado['nome_cli']; ?>" disabled />
                  </div>
                </div>
                <div class="col-md-4" id="infocima">
                  <div class="form-group">
                    <label class="label" for="Preco" style="margin-left: 3%">Preço:</label>
                    <input type="text" class="form-control" required name="Preco" id="Preco" value="<?php echo $dado['preco_final']; ?>" disabled />
                  </div>
                  <div class="form-group">
                    <label class="label" for="Gênero" style="margin-left: 3%">Gênero:</label>
                    <input type="text" class="form-control" required name="Gênero" id="Gênero" value="<?php echo $dado['genero']; ?>" disabled />
                  </div>
                </div>
                <div class="form-group">
                  <label class="label" for="Esp" style="margin-left: 3%">Especialidade:</label>
                  <input type="text" class="form-control" required name="Esp" id="Esp" value="<?php echo $dado['esp_exp']; ?>" disabled />
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label class="label" for="DataPedido" style="margin-left: 3%">Data do Pedido:</label>
                    <input class="form-control" required name="DataPedido" id="DataPedido" value="<?php echo date('d/m/Y', strtotime($dado['data_contratacao'])); ?>" disabled />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="label" for="Cidade" style="margin-left: 3%">Cidade:</label>
                    <input type="text" class="form-control" required name="Cidade" id="Cidade" value="<?php echo $dado['cidade']; ?>" disabled />
                  </div>
                </div>
                <div class="col-md-3" style="padding-top: 2.2px">
                  <div class="form-group">
                    <label class="label" for="UF" style="margin-left: 3%">Estado:</label>
                    <input type="text" class="form-control" required name="UF" id="UF" value="<?php echo $dado['estado']; ?>" disabled />
                  </div>
                </div>
                <div class="col-md-12" style="padding-top: 4%; margin-bottom: 10px">
                  <div class="form-group1">
                    <label class="label" for="Biografia" style="margin-left: 3%">Biografia:</label>
                    <textarea class="form-control" id="Biografia" rows="3" disabled><?php echo $dado['biografia']; ?></textarea>
                  </div>
                </div>
                <input type="hidden" class="form-control" name="cliente" id="cliente" value="<?php echo $dado['Id_cli']; ?>" />
              </div>
              <div class="buttons">
                <button type="submit" id="btnEntrar" class="btnEntrar">
                  Finalizar
                </button>
                <button type="submit" formaction="TrabalhosPendentes.php" id="btnPress" class="btnPress">
                  Ver Mais
                </button>
              </div>
            </form>
          <?php }
        } else { ?>
          <img src="../../img/Logo-StreamLine-TCC-ELY_CHATEADA.png" style="max-width:13em;max-height:13em;margin-left:auto;margin-right:auto;display:block;" alt="eli_chateada">
          <h4 style="text-align: center;">Não há Trabalhos Pendentes</h4>
        <?php   }
        ?>
      </div>
    </div>
  </div>




  <form>
    <section id="funciona" style="background-color: #011526">
      <div id="carousel" class="carousel slide w-100" data-bs-ride="carousel">
        <div class="carousel-inner w-100" style="padding-top: 7%">
          <div class="row">
            <div class="col-sm-7">
              <h3 class="d-block" style="
                  font-weight: bold;
                  color: #f2f2f2;
                  text-align: center;
      
                  margin: 0;
                ">
                Perfis de Clientes
              </h3>
              <h5 class="d-block" style="
                  margin-top: 15px;
                  color: #f2f2f2;
                  text-align: center;
      
                ">
                Clientes que requisitaram seus serviços
              </h5>
            </div>
            <div class="col-sm-4">
              <center>
                <button type="submit" formaction="ContratacaoAutonomo.php" id="seeMore" class="seeMore">
                  Ver Mais
                </button>
              </center>
            </div>
          </div>
  </form>
  <?php
  $contratacao = "SELECT C.Id_cli, C.nome_cli, C.foto_perfil, C.biografia, C.genero, C.cep, C.estado, 
        C.cidade, A.profissao, A.esp_exp, A.preco_fixo,  E.Avaliacao_cli, O.data_orcamento FROM orcamento O 
        INNER JOIN cadastroprofissional A ON O.Id_prof = A.Id_prof
        INNER JOIN avaliacoescliente E ON O.Id_cli = E.Id_cli
        INNER JOIN cadastrocliente C ON O.Id_cli = C.Id_cli WHERE O.Id_prof = $id_prof LIMIT $pagina, $itens_carousel;";
  $consult = $con->query($contratacao);

  if ($consult->num_rows > 0) {
    while ($autonomo = mysqli_fetch_assoc($consult)) {
      //AVALIAÇÕES
      $id_cli = $autonomo['Id_cli'];
      $subcons = "SELECT AVG(DISTINCT Avaliacao_cli) as AvaliacaoCli FROM avaliacoescliente where Id_cli = $id_cli;";
      $avali = $con->query($subcons);

      while ($avalia = mysqli_fetch_assoc($avali)) { 

        $aval_value = $avalia['AvaliacaoCli'];
      }
  ?>
      <div class="carousel-item active">
        <div class="row">
          <div class="col-sm-5">
            <div class="card-carousel" style="max-width: 700px;">
              <div class="card-body">
                <form method="post" action="" id="form" name="form">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="estrelas">
                        <label for="cm_star-1"><?php echo substr($aval_value, 0, 3); ?> <i class="fa"></i></label>
                      </div>
                      <center>
                        <img src="<?php echo '../cliente/perfil/' . $autonomo['foto_perfil'] ?>" class="img-fluid" alt="user" style="
                            width: 150px; height: 150px; object-fit: cover;
                            background: #182b3d;
                            margin-top: 3%;
                            margin-bottom: 5%;
                            border-radius: 10px;
                          " />
                      </center>
                    </div>
                    <input type="hidden" class="form-control" name="cliente" id="cliente" value="<?php echo $autonomo['Id_cli']; ?>" />
                    <div class="col-md-6" id="infocima">
                      <div class="form-group">
                        <label class="label" for="Prof" style="margin-left: 3%">Profissão:</label>
                        <input type="text" class="form-control" required name="Prof" id="Prof" value="<?php echo $autonomo['profissao']; ?>" disabled />
                      </div>
                      <div class="form-group">
                        <label class="label" for="Nome" style="margin-left: 3%">Nome:</label>
                        <input type="text" class="form-control" required name="Nome" id="Nome" value="<?php echo $autonomo['nome_cli']; ?>" disabled />
                      </div>
                    </div>
                    <div class="col-md-6" id="infocima">
                      <div class="form-group">
                        <label class="label" for="Preco" style="margin-left: 3%">Preço por aula:</label>
                        <input type="text" class="form-control" required name="Preco" id="Preco" value="<?php echo $autonomo['preco_fixo']; ?>" disabled />
                      </div>
                      <div class="form-group">
                        <label class="label" for="Gênero" style="margin-left: 3%">Gênero:</label>
                        <input type="text" class="form-control" required name="Gênero" id="Gênero" value="<?php echo $autonomo['genero']; ?>" disabled />
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="label" for="Esp" style="margin-left: 2%">Especificações:</label>
                      <input type="text" class="form-control" required name="Esp" id="Esp" value="<?php echo $autonomo['esp_exp']; ?>" disabled />
                    </div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="label" for="Cidade" style="margin-left: 3%">Cidade:</label>
                        <input type="text" class="form-control" required name="Cidade" id="Cidade" value="<?php echo $autonomo['cidade']; ?>" disabled />
                      </div>
                    </div>
                    <div class="col-md-4" style="padding-top: 10px">
                      <div class="form-group">
                        <label class="label" for="UF" style="margin-left: 3%">Estado:</label>
                        <input type="text" class="form-control" required name="UF" id="UF" value="<?php echo $autonomo['estado']; ?>" disabled />
                      </div>
                    </div>
                    <div class="col-md-12" style="padding-top: 4%; margin-bottom: 10px">
                      <div class="form-group1">
                        <label class="label" for="Biografia" style="margin-left: 2%">Biografia:</label>
                        <textarea class="form-control" id="Biografia" rows="3" disabled><?php echo $autonomo['biografia']; ?>"</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="buttons">
                    <button type="submit" formaction="bd_conexao/descartarCliente.php" id="btnEntrar" class="btnEntrar">
                      Descartar
                    </button>
                    <button type="submit" formaction="AutonomoAceitarServico.php" id="btnPress" class="btnPress">
                      Ver Mais
                    </button>
                  </div>
                </form>
              <?php }
          } else { ?>
              <center>
                <br>
                <img src="../../img/Logo-StreamLine-TCC-ELY_CHATEADA.png" style="max-width:13em;max-height:13em;margin-left:auto;margin-right:auto;display:block;" alt="eli_chateada">
                <h3 style="color:#f2f2f2;">Não há Requisições</h3>
                <br>
                <br>
              </center>
            <?php   }
            ?>
              </div>
            </div>
          </div>
        </div>

      </div>
      </div>
      <button class="carousel-control-prev" role="button" data-bs-target="#carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" role="button" data-bs-target="#carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
      </div>
      </section>


      <section id="dicas">
        <div class="containerInfo container-fluid" style="
          background-color: #f2f2f2;
          padding-top: 5%;
          min-height: 700px;
          align-content: center;
          justify-content: center;
        ">
          <h3 class="tituloInfo" style="
            font-weight:bold;
            padding-top: 3%;
            text-align: center;
          ">
            Como Melhorar Seu Perfil
          </h3>
          <p style="
            margin-top: 2%;
            text-align: center;
            margin-left: 20%;
            margin-right: 20%;
            margin-bottom: 10%;
          ">
            Para obter um avanço na sua jornada de profissional como autonomo
            podemos dar algumas dicas essenciais que vão potencializar o seu
            perfil!
          </p>
          <div class="row">
            <div class="col-sm-4">
              <h5 style="text-align: center;font-weight:bold;">
                Tenha um perfil completo:
              </h5>
              <p style="margin-top: 1%; text-align: center; margin-bottom: 10%">
                Crie uma biografia profissional;
                <br />
                Mantenha seu perfil atualizado;
                <br />
                Evite erros de ortografia.
              </p>
            </div>
            <div class="col-sm-4">
              <h5 style="text-align: center;font-weight:bold;">
                Tenha uma boa relação com os clientes:
              </h5>
              <p style="margin-top: 1%; text-align: center; margin-bottom: 10%">
                Seja ativo no site;
                <br />
                Conquiste boas avaliações;
                <br />
                Seja disciplinado e ético.
              </p>
            </div>
            <div class="col-sm-4">
              <h5 style="text-align: center;font-weight:bold;">
                Use uma boa foto de perfil:
              </h5>
              <p style="margin-top: 1%; text-align: center; margin-bottom: 5%">
                Alta definição;
                <br />
                Fundo neutro;
                <br />
                Boa postura;
                <br />
                Vestimentas adequadas.
              </p>
            </div>
          </div>
        </div>
      </section>
      <footer>
        <p>© 2022 StreamLine - LMNNY</p>
      </footer>
</body>

</html>
