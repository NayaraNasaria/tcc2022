<?php
session_start();
include('../protect/ProtectCli.php');
include('../bd_conexao/conexao.php');

$id_cli= $_SESSION['Id_cli'];
$autonomo = $_POST['autonomo'];

$cons = "SELECT P.Id_prof, P.nome_prof, P.foto_perfil, P.email_prof,
P.profissao, P.esp_exp, C.nome_cli, S.data_contratacao, S.quant_horas, S.preco_final
FROM servico S 
INNER JOIN cadastroprofissional P ON S.Id_prof = P.Id_prof
INNER JOIN cadastrocliente C ON S.Id_cli = C.Id_cli
 WHERE S.Id_prof = $autonomo;";
$consulta = $con->query($cons);


if($consulta->num_rows > 0){
  while($dados = mysqli_fetch_assoc($consulta)){
    $autonomo = $dados['Id_prof'];
    $nome_cli = $dados['nome_cli'];
    $email_prof= $dados['email_prof'];
    $nome = $dados['nome_prof']; 
    $perfil = $dados['foto_perfil'];
    $profissao = $dados['profissao'];
    $esp_exp = $dados['esp_exp'];
    $preco = $dados['preco_final'];
    $data_contratacao = $dados['data_contratacao'];
    $quant_horas = $dados['quant_horas'];
  }
}else{
  header('Location: AvaliacaoAutonomo.php');
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
  <title>Denúncia</title>
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
              <li><a class="dropdown-item" href="../protect/logout.php">Sair</a></li>            </ul>
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
          Denunciar Profissional
        </h2>
        <p class="label" style="text-align: center;">Faça sua denúncia com responsabilidade</p>
      </div>
      <div class="col-sm-5">
        <a href="InicialClientesTrabPendentes.php"><button type="button" id="btnVoltar" class="btnVoltar">
            Voltar
          </button></a>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <form method="post" action="../bd_conexao/denunciarAutonomo.php" id="form" name="form">
          <div class="row">
            <div class="col-md-5" style="padding-top: 2%;">
              <center>
                <img src="<?php echo '../autonomo/perfil/' . $perfil ?>" class="img-fluid" alt="user" style="
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
                <label class="label" for="Nome" style="margin-left: 3%">Nome do Profissional:</label>
                <input type="text" class="form-control" required name="nome" id="nome" value="<?php echo $nome; ?>" readonly />
              </div>
              <div class="form-group">
                <label class="label" for="DataContrat" style="margin-left: 3%">Data da Contratação:</label>
                <input type="text" class="form-control" required name="dataContrato" id="dataContrato" value="<?php $data = $data_contratacao;
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
                <label class="label" for="Denuncia" style="margin-left: 3%">Qual é o motivo da denúncia?</label>
                <input type="text" class="form-control" required name="denuncia" id="denuncia" />
              </div>
              <div class="form-group">
                <label class="label" for="comentario" style="margin-left: 2%">Deixe aqui sua reclamação:</label>
                <textarea class="form-control" id="comentario" name="comentario" rows="5"></textarea>
              </div>

              <input type="hidden" class="form-control" name="autonomo" id="autonomo" value="<?php echo $autonomo; ?>" />
             <input type="hidden" class="form-control" name="email_prof" id="email_prof" value="<?php echo $email_prof;?>" />

              <button style="margin-top: 6%;" type="submit" id="btnDenunciar" class="btnDenunciar">
                Finalizar Denúncia
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
