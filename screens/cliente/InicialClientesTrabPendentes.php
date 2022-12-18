<?php
session_start();
include('../protect/ProtectCli.php');
include('../bd_conexao/conexao.php');

$id_cli = $_SESSION['Id_cli'];
$itens_pagina = 1; // quantidade por página
$pagina = 0; //página atual
$itens_carousel = 1;
$data_atual = date('Y-m-d');
date_default_timezone_set('America/Sao_Paulo'); //converter para horário de Brasília
$horario_atual = date('H:i:s', time());

//Consulta trabalhos pendentes
$cons = "SELECT P.Id_prof, P.nome_prof, P.genero, P.cidade, P.estado, P.profissao,
P.biografia, P.foto_perfil, S.preco_final, P.esp_exp, S.data_contratacao
from servico S 
INNER JOIN cadastroprofissional P ON 
S.Id_prof = P.Id_prof
WHERE S.hora_finalizacao = '00:00:00' 
and S.Id_cli = $id_cli LIMIT $pagina, $itens_pagina;";
$consulta = $con->query($cons);
//Fim da Consulta trabalhos pendentes

//AS AVALIAÇÕES PENDENTES
$aval = "SELECT A.nome_prof, A.foto_perfil, A.Id_prof, A.profissao, A.esp_exp, V.Avaliacao_prof, V.Comentario_prof,
V.data_aval_prof
FROM avaliacoesprofissional V 
INNER JOIN cadastroprofissional A ON A.Id_prof = V.Id_prof 
WHERE V.data_aval_prof = 0 and V.Comentario_prof = 0 and V.Avaliacao_prof = 0 and V.Id_cli = $id_cli LIMIT $pagina, $itens_pagina;";
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
      <a class="navbar-brand">StreamLine</a>
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
              <li><a class="dropdown-item" href="TrabalhosRealizadosCliente.php">Finalizados</a></li>
              <li><a class="dropdown-item" href="TrabalhosPendentesCliente.php">Pendentes</a></li>
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
      $id_prof = $aval['Id_prof'];
      $subconsulta = "SELECT AVG(DISTINCT Avaliacao_prof) as AvaliacaoProf FROM avaliacoesprofissional where Id_prof = $id_prof;";
      $avaliacoes = $con->query($subconsulta);

      while ($avali = mysqli_fetch_assoc($avaliacoes)) { 

        $aval_values = $avali['AvaliacaoProf'];
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
          <h5 style="margin-top:5%;text-align: center;">
            Avalie o trabalhador para navegar
          </h5>
        </div>
        <div class="card">
          <div class="card-body">

            <form method="POST" id="form" name="form">
              <div class="row">
                <div class="col">
                  <div class="estrelas">
                    <label for="cm_star-1"><?php echo substr($aval_values, 0, 3); ?> <i class="fa"></i></label>
                  </div>
                  <center>
                    <img src="<?php echo '../autonomo/perfil/' . $aval['foto_perfil'] ?>" class="img-fluid" alt="user" style="
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
                  <input type="text" class="form-control" required name="Nome" id="Nome" value="<?php echo $aval['nome_prof']; ?>" disabled />
                </div>
                <div class="form-group">
                  <label class="label" for="Esp" style="margin-left: 3%">Especialidade:</label>
                  <input type="text" class="form-control" required name="Esp" id="Esp" value="<?php echo $aval['esp_exp']; ?>" disabled />
                </div>
              </div>
              <input type="hidden" class="form-control" name="autonomo" id="autonomo" value="<?php echo $aval['Id_prof']; ?>" />
              
              <div class="buttons">
                <button type="submit" formaction="DenunciarAutonomo.php" id="btnEntrar" class="btnEntrar">
                  Denunciar
                </button>
                <button type="submit" 
                formaction="AvaliacaoAutonomo.php" 
                id="btnPress" class="btnPress">
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


  <div class="container container-fluid" style="background-color: #f2f2f2; padding-top: 3.5%; min-height: 800px">
    <div class="col-sm-6" style="margin-bottom: 5%;">
      <h3 style="
          font-weight: bold;
          margin: 0;
          text-align: center;
        ">
        Profissionais Pendentes
      </h3>
      <h5 style="margin-top:5%;text-align: center;">
        Profissionais com serviços não finalizados
      </h5>
    </div>
    <!-- Trabalhos Pendentes -->
    <div class="card">
      <div class="card-body">
        <?php
        if ($consulta->num_rows > 0) {
          while ($dado = mysqli_fetch_assoc($consulta)) {

            //AVALIAÇÕES
            $id_prof = $dado['Id_prof'];
            $subconsulta = "SELECT AVG(DISTINCT Avaliacao_prof) as AvaliacaoProf FROM avaliacoesprofissional where Id_prof = $id_prof;";
            $avaliacoes = $con->query($subconsulta);

            while ($avali = mysqli_fetch_assoc($avaliacoes)) { 

              $aval_valor = $avali['AvaliacaoProf'];
}
        ?>
            <form method="post" action="ClienteFinalizarServico.php" id="form" name="form">
              <div class="row">
                <div class="col">
                  <div class="estrelas">
                    <label for="cm_star-1"><?php echo substr($aval_valor, 0, 3); ?> <i class="fa"></i></label>
                  </div>
                  <center>
                    <img src="<?php echo '../autonomo/perfil/' . $dado['foto_perfil'] ?>" class="img-fluid" alt="user" style="
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
                    <input type="text" class="form-control" required name="profissao" id="profissao" value="<?php echo $dado['profissao']; ?>" disabled />
                  </div>
                  <div class="form-group">
                    <label class="label" for="Nome" style="margin-left: 3%">Nome:</label>
                    <input type="text" class="form-control" required name="Nome" id="Nome" value="<?php echo $dado['nome_prof']; ?>" disabled />
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
                  <label class="label" for="Esp" style="margin-left: 2%">Especialidade:</label>
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
                    <label class="label" for="Biografia" style="margin-left: 2%">Biografia:</label>
                    <textarea class="form-control" id="Biografia" rows="3" disabled><?php echo $dado['biografia']; ?></textarea>
                  </div>
                </div>
                <input type="hidden" class="form-control" name="autonomo" id="autonomo" value="<?php echo $dado['Id_prof']; ?>" />
              </div>
              <div class="buttons">
                <button type="submit" id="btnEntrar" class="btnEntrar">
                  Finalizar
                </button>
                <button type="submit" formaction="TrabalhosPendentesCliente.php" id="btnPress" class="btnPress">
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
  <!-- Fim Trabalhos Pendentes -->
  <section id="princAutonomo" style="background-color: #f2f2f2">
    <div id="carousel" class="carousel slide w-100" data-bs-ride="carousel">
      <div class="carousel-inner w-100" style="padding-top: 5%">
        <div class="row">
          <div class="col-sm-7">
            <h3 class="d-block" style="
              color: black;
              text-align: center;
              font-weight:bold;
              margin: 0;
            ">
              Principais Autônomos
            </h3>
          </div>
          <div class="col-sm-4">
            <center>
              <a href="ContratacaoAutonomoCliente.php">
                <button type="submit" style="width: 45%;
              margin-bottom: 5%;
              padding: 7px;
              border-radius: 10px;
              background-color: #2e608c;
              color: white;
              border: #2e608c;">
                  Ver Mais
                </button>
              </a>
            </center>
          </div>
        </div>
        <?php
        $contratacao = "SELECT P.Id_prof, P.nome_prof, P.genero, P.profissao, P.tempo_exp, 
          P.espTempo, P.esp_exp, P.biografia, P.data_nascimento, P.data_cadProf, P.contato, P.cep, P.numero_casa, 
          P.complemento, P.cidade, P.estado, P.link, P.preco_fixo, P.foto_perfil, E.Avaliacao_prof 
          FROM cadastroprofissional P
          INNER JOIN avaliacoesprofissional E ON P.Id_prof = E.Id_prof WHERE P.ativo = '1' ORDER BY E.Avaliacao_prof ASC LIMIT $pagina, $itens_carousel;";
        $consult = $con->query($contratacao);

        while ($autonomo = mysqli_fetch_assoc($consult)) {
          //AVALIAÇÕES
              $id_prof = $autonomo['Id_prof'];
              $subconsulta = "SELECT AVG(DISTINCT Avaliacao_prof) as AvaliacaoProf FROM avaliacoesprofissional where Id_prof = $id_prof;";
              $avaliacoes = $con->query($subconsulta);

              while ($avalia = mysqli_fetch_assoc($avaliacoes)) { 

                $avali_valor = $avalia['AvaliacaoProf'];
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
                            <label for="cm_star-1"><?php echo substr($avali_valor, 0, 3); ?> <i class="fa"></i></label>
                          </div>
                          <center>
                            <img src="<?php echo '../autonomo/perfil/' . $autonomo['foto_perfil'] ?>" class="img-fluid" alt="user" style="
                            width: 150px; height: 150px; object-fit: cover;
                            background: #182b3d;
                            margin-top: 3%;
                            margin-bottom: 5%;
                            border-radius: 10px;
                          " />
                          </center>
                        </div>
                        <div class="col-md-6" id="infocima">
                          <div class="form-group">
                            <label class="label" for="Prof" style="margin-left: 3%">Profissão:</label>
                            <input type="text" class="form-control" required name="Prof" id="Prof" value="<?php echo $autonomo['profissao']; ?>" disabled />
                          </div>
                          <div class="form-group">
                            <label class="label" for="Nome" style="margin-left: 3%">Nome:</label>
                            <input type="text" class="form-control" required name="Nome" id="Nome" value="<?php echo $autonomo['nome_prof']; ?>" disabled />
                          </div>
                        </div>
                        <div class="col-md-6" id="infocima">
                          <div class="form-group">
                            <label class="label" for="Preco" style="margin-left: 3%">Preço:</label>
                            <input type="text" class="form-control" required name="Preco" id="Preco" value="<?php echo $autonomo['preco_fixo']; ?>" disabled />
                          </div>
                          <div class="form-group">
                            <label class="label" for="Gênero" style="margin-left: 3%">Gênero:</label>
                            <input type="text" class="form-control" required name="Gênero" id="Gênero" value="<?php echo $autonomo['genero']; ?>" disabled />
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="label" for="Esp" style="margin-left: 2%">Especialidade:</label>
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
                            <textarea class="form-control" id="Biografia" rows="3" disabled><?php echo $autonomo['biografia']; ?></textarea>
                          </div>
                          <input type="hidden" class="form-control" name="autonomo" id="autonomo" value="<?php echo $autonomo['Id_prof']; ?>" />
                          <div class="buttons">
                            <button type="submit" formaction="ContratAutonomoOrcamento.php" id="btnPress" class="btnPress">
                              Ver Mais
                            </button>

                          </div>
                        </div>
                      </div>
                    </form>
                  <?php
                }
                  ?>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <button class="carousel-control-prev" role="button" data-bs-target="#carousel" data-bs-slide="prev" style="opacity: 5;">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" role="button" data-bs-target="#carousel" data-bs-slide="next" style="opacity: 5;">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
      </div>
  </section>

  <section id="funciona" style="background-color: #011526">
    <div id="carousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <h3 class="d-block w-100" style="
                font-weight:bold;
                color: #f2f2f2;
                text-align: center;
                margin-top: 7%;
                margin-top:5%;              ">
            Profissional
          </h3>
          <p style="
                margin-top: 2%;
                text-align: left;
                margin-left: 25%;
                margin-right: 25%;
                color: #f2f2f2;
                margin-bottom: 10%;
              ">
            Aqui o profissional poderá realizar seu cadastro adicionando sua
            área de atuação e inserindo uma ou mais especificações, a fim de
            que o cliente tenha acesso aos seus serviços de forma rápida e
            eficiente.
          </p>
        </div>
        <div class="carousel-item">
          <h3 class="d-block w-100" style="
                font-weight:bold;
                color: #f2f2f2;
                text-align: center;
                margin-top: 7%;
                margin-top:5%;              ">
            Serviços
          </h3>
          <p style="
                margin-top: 2%;
                text-align: left;
                margin-left: 25%;
                margin-right: 25%;
                color: #f2f2f2;
                margin-bottom: 10%;
              ">
            Este é o site que você encontrará o serviço que procura. Basta
            clicar em "Buscar" ou selecionar algum nas áreas acima. Para
            entrar em contato com o prestador de serviços, será necessário
            criar um cadastro como cliente. Já você, profissional, crie seu
            cadastro como autônomo e tenha seus serviços divulgados.
          </p>
        </div>
        <div class="carousel-item">
          <h3 class="d-block w-100" style="
                font-weight:bold;
                color: #f2f2f2;
                text-align: center;
                margin-top: 7%;
                margin-top:5%;              ">
            Clientes
          </h3>
          <p style="
                margin-top: 2%;
                text-align: left;
                margin-left: 25%;
                margin-right: 25%;
                color: #f2f2f2;
                margin-bottom: 10%;
              ">
            Para clientes que através desse site procura um profissional que
            atenda suas necessidades, aqui você encontrará! Para isso, crie
            seu cadastro de cliente. Se deseja consultar orçamentos dos
            serviços, entrar em contato com o profissional e fechar negócion,
            aqui é o lugar certo!
          </p>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
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
            Crie uma biográfia profissional;
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
