<?php
session_start();
include('../bd_conexao/conexao.php');
include('../protect/ProtectCli.php');

$id_cli = $_SESSION['Id_cli'];
$autonomo = $_POST['autonomo'];


$cons = "SELECT * FROM `cadastroprofissional` WHERE
Id_prof = $autonomo;";
$consulta = $con->query($cons);

if ($consulta->num_rows > 0) {
  while ($dados = mysqli_fetch_assoc($consulta)) {
    $id = $dados['Id_prof'];
    $nome = $dados['nome_prof'];
    $contato = $dados['contato'];
    $perfil = $dados['foto_perfil'];
    $profissao = $dados['profissao'];
    $esp_exp = $dados['esp_exp'];
    $preco = $dados['preco_fixo'];
  }
} else {
  header('Location: contratAutonomoOrcamento.php');
}

//AVALIAÇÕES
$subconsulta = "SELECT AVG(DISTINCT Avaliacao_prof) as AvaliacaoProf FROM avaliacoesprofissional where Id_prof = $id;";
$avaliacoes = $con->query($subconsulta);

while ($avali = mysqli_fetch_assoc($avaliacoes)) { 

  $aval_valor = $avali['AvaliacaoProf'];
}

//Consulta se há avaliação e caso tenha, não contrata
$avaliacao = mysqli_query ($con, "SELECT * FROM `avaliacoesprofissional` WHERE
data_aval_prof = 0 and Comentario_prof = 0
and Avaliacao_prof = 0 and Id_cli = $id_cli"); 
//Fim da Consulta

//Bloqueio de aceitação de serviço caso tenha avaliações pendentes
$quant = $avaliacao->num_rows;
if($quant == 1){
  echo "<script>alert('Você não pode Contratar! \nHá uma avaliação pendente!')</script>";
  header('Location: ../cliente/InicialClientesTrabPendentes.php');
}else{
}
//Fim

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
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
  <title>Contratação Orçamentária</title>
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
              <img class="user" src="../../img/user.svg" alt="user" style="height: 25px; margin-right: 2px" />
              Perfil
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <div class="dropdown-divider" style="width: 60%; background-color: black"></div>
              <li><a class="dropdown-item" href="InicialClientesTrabPendentes.php">ᐅ Minha Área</a></li>
              <li><a class="dropdown-item" href="TrabalhosPendentesCliente.php">ᐅ Trabalhos</a></li>
              <li><a class="dropdown-item" href="../protect/logout.php">Sair</a></li>            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container container-fluid" style="background-color: #f2f2f2; padding-top: 3.5%; min-height: 1000px">
    <div class="row">
      <div class="col-sm-6" style="margin-bottom: 5%">
        <h2 style="
              font-family: Playfair Display;
              font-weight: 500;
              margin: 0;
              text-align: center;
            ">
          Perfil de Profissional
        </h2>
      </div>
      <div class="col-sm-5">
        <a href="../Home.html"><button type="button" id="btnVoltar" class="btnVoltar">
            Voltar
          </button></a>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <form method="post" action="Orcamento.php" id="form" name="form" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-12">
              <div class="estrelas">
              <label for="cm_star-1"><?php echo substr($aval_valor,0,3); ?> <i class="fa"></i></label>
              </div>

              <center>
                <img src="<?php echo '../autonomo/perfil/' . $perfil; ?>" class="img-fluid" name="perfil" alt="user" style="
                      width: 150px; height: 150px; object-fit: cover;
                      background: #182b3d;
                      margin-top: 3%;
                      margin-bottom: 5%;
                      border-radius: 10px;
                    " />

              </center>

            </div>
            <input type="hidden" class="form-control" name="autonomo" id="autonomo" value="<?php echo $id; ?>" />
            <div class="col-md-6" id="infocima" style="margin: 0">
              <div class="form-group">
                <label class="label" for="Nome" style="margin-left: 3%">Nome do Profissional:</label>
                <input type="text" class="form-control" required name="nome" id="nome" value="<?php echo $nome; ?>" readonly />
              </div>
              <div class="form-group">
                <label class="label" for="Telefone" style="margin-left: 3%">Telefone:</label>
                <input type="text" class="form-control" required name="telefone" id="telefone" value="<?php echo $contato; ?>" readonly />
              </div>
              <div class="form-group">
                <label class="label" for="Preco" style="margin-left: 3%">Preco Fixo por Hora:</label>
                <input type="text" class="form-control" required name="preco" id="preco" value="<?php echo $preco; ?>" readonly />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="label" for="Prof" style="margin-left: 3%">Profissão:</label>
                <!-- <input type="text" class="form-control" required name="area" id="area" value="<?php echo $profissao; ?>" readonly /> -->
                <select type="text" select class="form-select" name="area" required id="area" value="<?php echo $profissao; ?>" readonly>
                                <option value="Diarista">  Diarista  </option>
                                <option value="Estética">  Estética  </option>
                                <option value="Aulas">  Aulas  </option>
                                <option value="Fotografia"> Fotografia </option>
                                <option value="Babá">Babá</option>
                            </select>
              </div>
              <div class="form-group">
                <label class="label" for="esp">Selecionar Especificações:</label>
                <select type="text" class="select2 form-control" multiple="multiple" name="esp" required id="esp"></select>
                <select class="hidden espDiarista">
                  <option value="Faxina Básica">Faxina Básica</option>
                  <option value="Faxina Completa">Faxina Completa</option>
                  <option value="Passar Roupa">Passar Roupa</option>
                </select>
                <select class="hidden espEstética">
                  <option value="Manicure">Manicure</option>
                  <option value="Pedicure">Pedicure</option>
                  <option value="Limpeza de Pele">Limpeza de Pele</option>
                  <option value="Design de Sobrancelha">
                    Design de Sobrancelha
                  </option>
                  <option value="Maquiagem Simples">Maquiagem Simples</option>
                  <option value="Maquiagem Elaborada">
                    Maquiagem Elaborada
                  </option>
                </select>
                <select class="hidden espAulas">
                  <option value="Humanas">Humanas</option>
                  <option value="Exatas">Exatas</option>
                  <option value="Língua Estrangeira">
                    Língua Estrangeira
                  </option>
                </select>
                <select class="hidden espFotografia">
                  <option value="Festa">Festa</option>
                  <option value="Formatura">Formatura</option>
                  <option value="Book Gravidez">Book Gravidez</option>
                </select>
                <select class="hidden espBabá">
                  <option value="Mensal">Mensal</option>
                  <option value="Temporada">Temporada</option>
                  <option value="Anual">Anual</option>
                </select>
              </div>
              <div class="form-group">
                <label class="label" for="quant_horas" style="margin-left: 3%">Quantidade de Horas:</label>
                <input type="text" class="form-control" required name="quant_horas" id="quant_horas" />
              </div>
            </div>
            <center>
              <div class="buttons">
                <button type="submit" id="btnEntrar" class="btnEntrar">
                  Cancelar
                </button>
                <button type="submit" id="btnPress" class="btnPress">
                  Orçamento
                </button>
              </div>
            </center>
          </div>
        </form>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
        <script>
          $(function() {
            $(".hidden").hide();

            $("select[id=esp]").html($("select.espDiarista").html());

            $("select[id=area]").change(function() {
              var id = $("select[id=area]").val();

              $("select[id=esp]").empty();

              $("select[id=esp]").html($("select.esp" + id).html());
            });
            $(".select2").select2();
          });
        </script>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
                <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />

                <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
                <script type="text/javascript">
                    var SPMaskBehavior = function(val) {
                            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
                        },
                        spOptions = {
                            onKeyPress: function(val, e, field, options) {
                                field.mask(SPMaskBehavior.apply({}, arguments), options);
                            }
                        };

                    $('#Telefone').mask(SPMaskBehavior, spOptions);
                </script>

      </div>
    </div>
  </div>
  <footer>
    <p>© 2022 StreamLine - LMNNY</p>
  </footer>
</body>

</html>
