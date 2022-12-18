<?php
include('../bd_conexao/conexao.php');


$itens_pagina = 4; // quantidade por página
$pagina = 0; //página atual

//FILTRO
$dados = filter_input_array(INPUT_GET, FILTER_DEFAULT);

if(!empty($dados['dataPublicacao'])){
  $cons = "SELECT P.Id_prof, P.nome_prof, P.genero, P.profissao, P.tempo_exp, P.ativo,
  P.espTempo, P.esp_exp, P.biografia, P.data_nascimento, P.data_cadProf, P.contato, P.cep, P.numero_casa, 
  P.complemento, P.cidade, P.estado, P.link, P.preco_fixo, P.foto_perfil FROM cadastroprofissional P
   where esp_exp = 'Humanas'  AND P.ativo = '1' ORDER BY P.data_cadProf DESC LIMIT $pagina, $itens_pagina;";
  $consulta = $con->query($cons);

}
elseif(!empty($dados['avali'])){ 
  $cons = "SELECT P.Id_prof, P.nome_prof, P.genero, P.profissao, P.tempo_exp, P.ativo,
  P.espTempo, P.esp_exp, P.biografia, P.data_nascimento, P.data_cadProf, P.contato, P.cep, P.numero_casa, 
  P.complemento, P.cidade, P.estado, P.link, P.preco_fixo, P.foto_perfil, E.Avaliacao_cli FROM cadastroprofissional P
  INNER JOIN avaliacoescliente E ON P.Id_prof = E.Id_prof where esp_exp = 'Humanas'  AND P.ativo = '1' 
  ORDER BY E.Avaliacao_cli DESC LIMIT $pagina, $itens_pagina;";
  $consulta = $con->query($cons);
}
elseif(!empty($dados['local'])){ 
  $cons = "SELECT P.Id_prof, P.nome_prof, P.genero, P.profissao, P.tempo_exp, P.ativo,
  P.espTempo, P.esp_exp, P.biografia, P.data_nascimento, P.data_cadProf, P.contato, P.cep, P.numero_casa, 
  P.complemento, P.cidade, P.estado, P.link, P.preco_fixo, P.foto_perfil FROM cadastroprofissional P
   where esp_exp = 'Humanas' AND P.ativo = '1'  ORDER BY P.cidade and P.estado DESC LIMIT $pagina, $itens_pagina;";
  $consulta = $con->query($cons);

}elseif(!empty($dados['prealto'])){ 
  $cons = "SELECT P.Id_prof, P.nome_prof, P.genero, P.profissao, P.tempo_exp, P.ativo,
  P.espTempo, P.esp_exp, P.biografia, P.data_nascimento, P.data_cadProf, P.contato, P.cep, P.numero_casa, 
  P.complemento, P.cidade, P.estado, P.link, P.preco_fixo, P.foto_perfil FROM cadastroprofissional P
   where esp_exp = 'Humanas' AND P.ativo = '1'  ORDER BY P.preco_fixo DESC LIMIT $pagina, $itens_pagina;";
  $consulta = $con->query($cons);

}elseif(!empty($dados['prebaixo'])){ 
  $cons = "SELECT P.Id_prof, P.nome_prof, P.genero, P.profissao, P.tempo_exp, P.ativo,
  P.espTempo, P.esp_exp, P.biografia, P.data_nascimento, P.data_cadProf, P.contato, P.cep, P.numero_casa, 
  P.complemento, P.cidade, P.estado, P.link, P.preco_fixo, P.foto_perfil FROM cadastroprofissional P
   where esp_exp = 'Humanas' AND P.ativo = '1'  ORDER BY P.preco_fixo ASC LIMIT $pagina, $itens_pagina;";
  $consulta = $con->query($cons);
}
else{
  //CONSULTA BANCO SEM FILTRO
  $cons = "SELECT P.Id_prof, P.nome_prof, P.genero, P.profissao, P.tempo_exp, P.ativo,
  P.espTempo, P.esp_exp, P.biografia, P.data_nascimento, P.data_cadProf, P.contato, P.cep, P.numero_casa, 
  P.complemento, P.cidade, P.estado, P.link, P.preco_fixo, P.foto_perfil FROM cadastroprofissional P
   where esp_exp = 'Humanas' AND P.ativo = '1'  LIMIT $pagina, $itens_pagina;";
  $consulta = $con->query($cons);
  }

//FIM DO FILTRO

// PAGINAÇÃO
// quantidade de valores no banco de dados
$num_total = $con->query("SELECT P.Id_prof, P.nome_prof, P.genero, P.profissao, P.tempo_exp, P.ativo,
P.espTempo, P.esp_exp, P.biografia, P.data_nascimento, P.data_cadProf, P.contato, P.cep, P.numero_casa, 
P.complemento, P.cidade, P.estado, P.link, P.preco_fixo, P.foto_perfil FROM cadastroprofissional P
 where esp_exp = 'Humanas' AND P.ativo = '1' ;")->num_rows;
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
  <title>Contratação Autônomo</title>
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
          <!-- <div class="search-box">
            <input type="text" class="search-text" placeholder="Buscar Nome">
            <a href="#" class="search-btn">
              <img src="../../img/search.svg" alt="lupa" height="20" width="20" style="margin-right: 5px;">
              <a class="search-txt">Buscar</a>
            </a>
          </div> -->

          <img class="home" src="../../img/casa.png" alt="home" style="height: 20px; width: 20px; margin-top: 8px" />
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../Home.html">Home</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Perfil</a>
          </li>
          <img class="user" src="../../img/user.svg" alt="vertical-line" style="height: 25px; margin-top: 8px;" /> -->
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">

    <!-- FILTRO -->
  <a href="../Home.html"><button type="button" id="btnVoltarHome" class="btnVoltarHome">
                Voltar
              </button></a>
              <form action="humanas.php" method="get" name="filtrobusca">
    <div class="accordion-color accordion-flush" id="accordionFlush">
      <div class="accordion-item">
        <a class="accordion collapsed" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne" style="text-decoration: none; color: black; font-family: Arial, Helvetica, sans-serif;">
          <h5 class="accordion-header" id="flush-headingOne" style="padding-left: 2%; padding-top: 2%; padding-bottom: 1%;">
            <img src="../../img/filter.png" alt="filter" style="height: 40px; width: 40px; margin-right: 1%; cursor: pointer;">Perfis de Autônomos
          </h5>
        </a>
        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlush">
          <div class="accordion-body">
            <div class="row">
              <div class="col">
                <h6 style="text-align: center; margin-bottom: 15px">Ordenar Por</h6>
                <center>
                  <div>
                    <label for="avali" class="l-radio">
                      <input type="radio" id="avali" name="avali" value="avali" tabindex="5">
                      <span>Avaliações</span>
                    </label>

                    <label for="local" class="l-radio">
                      <input type="radio" id="local" name="local" value="local" tabindex="6">
                      <span>Localização</span>
                    </label>

                    <label for="prealto" class="l-radio">
                      <input type="radio" id="prealto" name="prealto" value="prealto" tabindex="7">
                      <span>Preços mais altos</span>
                    </label>

                    <label for="prebaixo" class="l-radio">
                      <input type="radio" id="prebaixo" name="prebaixo" value="prebaixo" tabindex="8">
                      <span>Preços mais baixos</span>
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

    <div class="card">
      <div class="card-body">

        <?php while ($dado = mysqli_fetch_assoc($consulta)) { 
          //AVALIAÇÕES
$id_prof = $dado['Id_prof'];
$subconsulta = "SELECT AVG(DISTINCT Avaliacao_prof) as AvaliacaoProf FROM avaliacoesprofissional where Id_prof = $id_prof;";
$avaliacoes = $con->query($subconsulta);

while ($avali = mysqli_fetch_assoc($avaliacoes)) { 

  $aval_valor = $avali['AvaliacaoProf'];
}
          ?>
          <form method="post" action="../cliente/loginCliente.php" id="form" name="form">
            <div class="row">
              <div class="col-sm-4">
                <div class="estrelas">
                <label for="cm_star-1"><?php echo substr($aval_valor,0,3); ?> <i class="fa"></i></label>
                </div>
                <center>
                  <img src="<?php echo '../autonomo/perfil/' . $dado['foto_perfil']; ?>" class="img-fluid" alt="user" style="width: 150px; margin-top: 3%; margin-bottom: 5%; border-radius: 50%;">
                </center>
              </div>
              <div class="col-md-4" id="infocima">
                <div class="form-group">
                  <label class="label" for="Nome">Nome:</label>
                  <input type="text" class="form-control" required name="nome" id="nome" value="<?php echo $dado['nome_prof']; ?>" disabled />
                </div>
                <div class="form-group">
                  <label class="label" for="TempExp">Tempo de Experiência:</label>
                  <input type="text" class="form-control" required name="TempExp" id="TempExp" value="<?php echo $dado['tempo_exp']; ?>" disabled />
                </div>
              </div>
              <div class="col-md-4" id="infocima">
                <div class="form-group">
                  <label class="label" for="Prof">Profissão:</label>
                  <input class="form-control" required name="prof" id="prof" value="<?php echo $dado['profissao']; ?>" disabled />
                </div>
                <div class="form-group">
                  <label class="label" for="Exp"></label>
                  <input type="text" class="form-control" required name="exp" id="exp" value="<?php echo $dado['espTempo']; ?>" disabled />
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group" style="padding-top: 3px;">
                  <label class="label" for="Preco">Preço Base:</label>
                  <input type="text" class="form-control" required name="preco" id="preco" value="<?php echo $dado['preco_fixo']; ?>" disabled />
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group" style="padding-top: 3px;">
                  <label class="label" for="Gênero">Gênero:</label>
                  <input type="text" class="form-control" required name="genero" id="genero" value="<?php echo $dado['genero']; ?>" disabled />
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label class="label" for="Cidade">Cidade:</label>
                  <input type="text" class="form-control" required name="cidade" id="cidade" value="<?php echo $dado['cidade']; ?>" disabled />
                </div>
              </div>
              <div class="col-md-3" style="padding-top: 5px;">
                <div class="form-group">
                  <label class="label" for="UF">Estado:</label>
                  <input type="text" class="form-control" required name="UF" id="UF" value="<?php echo $dado['estado']; ?>" disabled />
                </div>
              </div>
              <div class="col-md-12" style="padding-top: 4%; margin-bottom: 10px;">
                <div class="form-group1">
                  <label class="label" for="Biografia">Biografia:</label>
                  <textarea class="form-control" id="biografia" disabled rows="3"><?php echo $dado['biografia']; ?></textarea>
                </div>
              </div>
              <input type="hidden" class="form-control" name="autonomo" id="autonomo" value="<?php echo $dado['Id_prof']; ?>" />
            </div>
            <div class="buttons">
              <button type="submit" id="btnPress" class="btnPress">
                Ver Mais
              </button>
            </div>
          </form>
          <br>
          <br>
        <?php } ?>
      </div>
    </div>

    <div class="page-content page-container" id="page-content">
      <div class="padding">
        <div class="row container-row d-flex justify-content-center">
          <div class="col-md-5 col-sm-6 grid-margin stretch-card">
            <nav>
              <ul class="pagination d-flex justify-content-center flex-wrap pagination-rounded-flat pagination-success">
                <li class="page-item"><a class="page-link" href="humanas.php?pagina=0" data-abc="true"><i class="fa fa-angle-left"></i></a>
                </li>
                <!-- numeração -->
                 <?php 
                for($i=0;$i<$num_paginas;$i++){ 
                  $estilo = "";
                  if($pagina == $i){
                    $estilo = "class=\"page-item active\"";
                  ?>
                <li class="page-item active" ><a class="page-link" href="humanas.php?pagina=<?php echo $i; ?>" data-abc="true"><?php echo $i+1; ?></a></li>
                <?php } ?>
                <?php } ?>
              <!-- Fim da numeração -->
                <li class="page-item"><a class="page-link" href="humanas.php?pagina=<?php echo $num_paginas-1; ?>" data-abc="true"><i
                      class="fa fa-angle-right"></i></a></li>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
