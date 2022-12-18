<?php
session_start();
include('../bd_conexao/conexao.php');

$autonomo = $_POST['autonomo'];
$nome = $_POST['nome'];
$esp = $_POST['esp'];
$quantidade_horas = $_POST['quant_horas'];
$preco_fixo = $_POST['preco'];
$tel = $_POST['telefone'];
$area = $_POST['area'];
$valor = $_POST['orcamento'];

$id_cli = $_SESSION['Id_cli'];
$data_atual = date('Y-m-d');
date_default_timezone_set('America/Sao_Paulo'); //converter para horário de Brasília
$horario_atual = date('H:i:s', time());


$sql = mysqli_query($con, "INSERT INTO `orcamento`(`id_orcamento`, `Id_cli`, `Id_prof`, 
`estimativa_preco`, `data_orcamento`, `hora_orcamento`, `preco_fixo`, `profissao`, `esp_exp`, 
`quantidade_horas`) VALUES ('','$id_cli','$autonomo','$valor','$data_atual','$horario_atual',
'$preco_fixo','$area','$esp','$quantidade_horas')");


if ($sql >= 1) {
  echo "<script>alert('Orçamento realizado com sucesso!')</script>";
} else {
  echo mysqli_connect_error();
  echo "<script>alert('Erro!');</script>";
}

$cons = "SELECT * FROM `cadastroprofissional` WHERE
Id_prof = $autonomo";
$consulta = $con->query($cons);

if ($consulta->num_rows > 0) {
  while ($dados = mysqli_fetch_assoc($consulta)) {
    $perfil = $dados['foto_perfil'];
    $autonomo = $dados['Id_prof'];
    
    //AVALIAÇÕES
$subconsulta = "SELECT AVG(DISTINCT Avaliacao_prof) as AvaliacaoProf FROM avaliacoesprofissional where Id_prof = $autonomo;";
$avaliacoes = $con->query($subconsulta);

while ($avali = mysqli_fetch_assoc($avaliacoes)) { 

  $aval_valor = $avali['AvaliacaoProf'];
}
  }
} else {
  header('Location: contratacaoAutonomoCliente.php');
}

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
  <title>Contratação Final Autônomo</title>
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
              <li><a class="dropdown-item" href="TrabalhosPendentes.php">ᐅ Trabalhos</a></li>
              <li><a class="dropdown-item" href="../protect/logout.php">Sair</a></li>
            </ul>
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
      <form method="post" action="ClienteContatarAutonomo.php" id="form" name="form">
          <div class="row">
            <div class="col-md-12">
              <div class="estrelas">
              <label for="cm_star-1"><?php echo substr($aval_valor,0,3); ?> <i class="fa"></i></label>
              </div>
              <center>
                <img src="<?php echo '../autonomo/perfil/' . $perfil; ?>" class="img-fluid" alt="user" style="
                      width: 150px; height: 150px; object-fit: cover;
                      background: #182b3d;
                      margin-top: 3%;
                      margin-bottom: 5%;
                      border-radius: 10px;
                    " />
              </center>
            </div>
            <div class="col-md-6" id="infocima" style="margin: 0">
              <div class="form-group">
                <label class="label" for="Nome" style="margin-left: 3%">Nome do Profissional:</label>
                <input type="text" class="form-control" required name="Nome" id="Nome" value="<?php echo $nome; ?>" disabled />
              </div>
              <div class="form-group">
                <label class="label" for="Link" style="margin-left: 3%">Preço base:</label>
                <input type="text" class="form-control" required name="preco" id="preco" value="<?php echo $preco_fixo; ?>" disabled />
              </div>
              <div class="form-group">
                <label class="label" for="Telefone" style="margin-left: 3%">Profissão:</label>
                <input type="text" class="form-control" required name="profissao" id="profissao" value="<?php echo $area; ?>" disabled />
              </div>

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="label" for="Prof" style="margin-left: 3%">Valor do Orçamento: </label>
                <input type="text" class="form-control" required name="valor_orcamento" id="valor_orcamento" value="<?php echo $valor; ?>" disabled />
              </div>
              <div class="form-group">
                <label class="label" for="esp">Especialidade:</label>
                <input type="text" class="form-control" required name="esp" id="esp" value="<?php echo $esp; ?>" disabled />
              </div>
              <div class="form-group">
                <label class="label" for="QtsHora" style="margin-left: 3%">Tempo de serviço:</label>
                <input type="text" class="form-control" required name="QtsHora" id="QtsHora" value="<?php echo $quantidade_horas; ?>" disabled />
              </div>
            </div>
            <input type="hidden" class="form-control" name="autonomo" id="autonomo" value="<?php echo $autonomo; ?>" />
          </div>
          <div class="buttons">
            <button type="submit" id="btnEntrar" class="btnEntrar">
              Cancelar
            </button>
            <button type="submit" id="btnPress" class="btnPress">
              Contratar
            </button>
          </div>
        </form>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
        <script>
          $(function() {
            $(".hidden").hide();

            $("select[name=esp]").html($("select.esp-a1").html());

            $("select[name=area]").change(function() {
              var id = $("select[name=area]").val();

              $("select[name=esp]").empty();

              $("select[name=esp]").html($("select.esp-a" + id).html());
            });
            $(".select2").select2();
          });
        </script>
      </div>
    </div>
  </div>
  <footer>
    <p>© 2022 StreamLine - LMNNY</p>
  </footer>
</body>

</html>
