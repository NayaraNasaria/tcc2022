<!-- Autonomo avalia cliente! -->
<?php
session_start();
include('../protect/Protect.php');
include('../bd_conexao/conexao.php');

$id_prof = $_SESSION['Id_prof'];
$cliente = $_POST['cli'];
$nomeprof = $_POST['nome_prof'];

$sql = mysqli_query ($con, "INSERT INTO `avaliacoescliente`(`Id_aval_cli`, `Id_prof`, 
`Id_cli`, `nome_prof`, `nome_cli`, `data_aval_cli`, `Comentario_cli`, `Avaliacao_cli`) VALUES 
('','$id_prof','$cliente','$nomeprof','','','','')");


$cons = "SELECT C.Id_cli, C.nome_cli, C.biografia,C.genero, C.email_cli,
C.link, C.data_nacimento, C.cidade, C.estado, C.foto_perfil, C.contato, C.Data_cadCli,
P.profissao, P.esp_exp, P.preco_fixo, P.nome_prof, P.esp_exp, S.quant_horas, S.preco_final,
S.data_contratacao FROM servico S 
INNER JOIN cadastrocliente C ON S.Id_cli = C.Id_cli 
INNER JOIN cadastroprofissional P ON S.Id_prof = P.Id_prof
 WHERE S.Id_cli = $cliente and S.Id_prof = $id_prof;";
$consulta = $con->query($cons);


if ($consulta->num_rows > 0) {
  while ($dados = mysqli_fetch_assoc($consulta)) {
    $id_cli = $dados['Id_cli'];
    $nome = $dados['nome_cli'];
    $nome_prof = $dados['nome_prof'];
    $bio = $dados['biografia'];
    $genero = $dados['genero'];
    $email = $dados['email_cli'];
    $link = $dados['link'];
    $nascimento = $dados['data_nacimento'];
    $contato = $dados['contato'];
    $dataCadastro = $dados['Data_cadCli'];
    $estado = $dados['estado'];
    $cidade = $dados['cidade'];
    $perfil = $dados['foto_perfil'];
    $profissao = $dados['profissao'];
    $esp_exp = $dados['esp_exp'];
    $preco = $dados['preco_fixo'];
    $preco_final = $dados['preco_final'];
    $data_contratacao = $dados['data_contratacao'];
    $quant_horas = $dados['quant_horas'];
  }
} else {
  // header('Location: AvaliacaoCliente.php');
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
  <title>Avaliação de Cliente</title>
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
              <li><a class="dropdown-item" href="InicialAutonomoTrabPendentes.php">ᐅ Minha Área</a></li>
              <li><a class="dropdown-item" href="TrabalhosPendentes.php">ᐅ Trabalhos</a></li>
              <li><a class="dropdown-item" href="../protect/logout.php">Sair</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container container-fluid" style="background-color: #f2f2f2; padding-top: 3.5%; min-height: 900px">
    <div class="row">
      <div class="col-sm-6" style="margin-bottom: 5%">
        <h2 style="
              font-family: Playfair Display;
              font-weight: 500;
              margin: 0;
              text-align: center;
            ">
          Avaliar Cliente
        </h2>
        <p class="label">Avalie este cliente para voltar a aceitar serviços</p>
      </div>
      <div class="col-sm-5">
        <a href="InicialAutonomoTrabPendentes.php"><button type="button" id="btnVoltar" class="btnVoltar">
            Voltar
          </button></a>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <?php
        if (isset($_SESSION['msg'])) {
          echo $_SESSION['msg'];
          unset($_SESSION['msg']);
        }
        ?>
        <form method="post" action="../bd_conexao/avaliarCliente.php" id="form" name="form" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-5" style="padding-top: 2%;">
              <center>
                <img src="<?php echo '../cliente/perfil/' . $perfil ?>" class="img-fluid" alt="user" style="
                      width: 150px; height: 150px; object-fit: cover;
                      background: #182b3d;
                      margin-top: 5%;
                      margin-bottom: 5%;
                      border-radius: 10px;
                    " />
              </center>
            </div>
            <div class="col-md-7" style="margin: 0">
              <div class="form-group">
                <label class="label" for="Nome" style="margin-left: 3%">Nome do Cliente:</label>
                <input type="text" class="form-control" required name="nome" id="nome" value="<?php echo $nome; ?>" readonly />
              </div>
              <div class="form-group">
                <label class="label" for="DataContrat" style="margin-left: 3%">Data da Contratação:</label>
                <input type="text" class="form-control" required id="dataContrato" value="<?php $data = $data_contratacao;
                                                                                          echo date_format(new DateTime($data), 'd/m/Y'); ?>" readonly />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="label" for="Prof" style="margin-left: 3%">Profissão Requisitada:</label>
                <input type="text" class="form-control" required name="area" id="area" value="<?php echo $profissao; ?>" readonly />
              </div>
              <div class="form-group">
                <label class="label" for="esp">Especialidade:</label>
                <input type="text" class="form-control" required name="esp" id="esp" value="<?php echo $esp_exp; ?>" readonly />
              </div>
              <div class="form-group">
                <label class="label" for="QtsHora" style="margin-left: 3%">Tempo de serviço:</label>
                <input type="text" class="form-control" required name="quant_horas" id="quant_horas" value="<?php echo $quant_horas; ?>" readonly />
              </div>
              <div class="form-group">
                <label class="label" for="Orcamento" style="margin-left: 3%">Valor do Orçamento:</label>
                <input type="text" class="form-control" required name="orcamento" id="orcamento" value="<?php echo $preco; ?>" readonly />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="label" for="Prof" style="margin-left: 3%">Selecione a quantidade de estrelas:</label>
                <div class="estrelas">
                  <input type="radio" id="cm_star-empty" name="estrela" value="" checked />
                  <label for="cm_star-1"><i class="fa"></i></label>
                  <input type="radio" id="cm_star-1" name="estrela" value="1" />
                  <label for="cm_star-2"><i class="fa"></i></label>
                  <input type="radio" id="cm_star-2" name="estrela" value="2" />
                  <label for="cm_star-3"><i class="fa"></i></label>
                  <input type="radio" id="cm_star-3" name="estrela" value="3" />
                  <label for="cm_star-4"><i class="fa"></i></label>
                  <input type="radio" id="cm_star-4" name="estrela" value="4" />
                  <label for="cm_star-5"><i class="fa"></i></label>
                  <input type="radio" id="cm_star-5" name="estrela" value="5" />
                </div>
              </div>
              <div class="form-group">
                <label class="label" for="Comentario" style="margin-left: 2%">Deixe seu comentário:</label>
                <textarea class="form-control" id="comentario" name="comentario" rows="3"></textarea>
              </div>
              <input type="hidden" class="form-control" name="cliente" id="cliente" value="<?php echo $id_cli; ?>" />
              <input type="hidden" class="form-control" name="nome_prof" id="nome_prof" value="<?php echo $nome_prof; ?>" />
              <br>
              <button type="submit" formaction="DenunciarCliente.php" id="btnDenunciar" class="btnDenunciar">
                Denunciar
              </button>

              <button type="submit" type="button" id="btnAvaliar" class="btnAvaliar">
                Finalizar Avaliação
              </button>

            </div>
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
