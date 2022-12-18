<?php
session_start();
include('../bd_conexao/conexao.php');

$id_cli = $_SESSION['Id_cli'];

$cons = "SELECT * FROM `cadastrocliente` WHERE Id_cli = $id_cli;";
$consulta = $con->query($cons);

if ($consulta->num_rows > 0) {
  while ($dados = mysqli_fetch_assoc($consulta)) {
    $nome = $dados['nome_cli'];
    $genero = $dados['genero'];
    $email = $dados['email_cli'];
    $senha = $dados['senha'];
    $data_nasc = $dados['data_nacimento'];
    $tel = $dados['contato'];
    $cep = $dados['cep'];
    $num_casa = $dados['numero_casa'];
    $comp = $dados['complemento'];
    $cidade = $dados['cidade'];
    $estado = $dados['estado'];
    $biografia = $dados['biografia'];
    $perfil = $dados['foto_perfil'];

    $link = "http://api.whatsapp.com/send?1=pt_BR&phone=55$tel";
  }
} else {
  header('Location: Home.html');
}

$aval = mysqli_query ($con, "UPDATE `avaliacoescliente` SET `Id_cli`='$id_cli' WHERE Id_prof = '1' and nome_prof = 'Admin'");
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
  <link rel="stylesheet" href="../../css/perfilAutonomo.css" />
  <link rel="stylesheet" href="../../css/navbar.css" />
  <link href="../../node_modules/jquery/dist/jquery.js" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
  <script src="../../node_modules/bootstrap/dist/js/bootstrap.js"></script>
  <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="../../js/function.js"></script>
  <title>Perfil Cliente</title>
</head>

<body>
<div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-faded" style="background-color: #152c40">

                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 min-vh-100">
                    <br />
                    <a href="/"
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-2 d-none d-sm-inline"
                            style="font-weight: bold; color: #f2f2f2">StreamLine</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu">
                        <form action="busca/buscaAutonomo.php" method="GET" name="buscaAutonomo">
                            <div class="search-boxData">
                                <input type="text" class="search-textData" placeholder="Buscar">
                                <a href="javascript:buscaAutonomo.submit()" class="search-btnData">
                                    <img src="../../img/search.svg" alt="lupa" height="20" width="20"
                                        style="margin-right: 5px;">
                                </a>
                            </div>
                        </form>
                        <li class="nav-item">
                            <a href="InicialClientesTrabPendentes.php" class="nav-link homenav align-middle px-0 pt-0"
                                style="color: #BF9052">
                                <i class="ms-2 fs-4 fa fa-home"></i> <span class="ms-1 d-none d-sm-inline"
                                    style="font-weight: bold; font-size: 17px;">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle"
                                style="color: #BF9052">
                                <i class="ms-2 fs-5 fa fa-user"></i> <span class="ms-1 d-none d-sm-inline">Perfil</span>
                                <i class="ms-1 fa fa-caret-down" aria-hidden="true"></i> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="dadosPessoaisClientes.php" style="color: cornflowerblue;"
                                        class="nav-link px-0"><i class="ms-3 fs-6 fa fa-user"></i> <span
                                            class="ms-1 d-none d-sm-inline">Dados pessoais</span></a>
                                </li>
                                <li>
                                    <a href="dadosPublicosClientes.php" style="color: cornflowerblue;"
                                        class="nav-link px-0"><i class="ms-3 fs-6 fa fa-users"></i> <span
                                            class="ms-1 d-none d-sm-inline">Dados públicos</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle"
                                style="color: #BF9052">
                                <i class="ms-2 fs-5 fa fa-briefcase"></i> <span
                                    class="ms-1 d-none d-sm-inline">Trabalhos</span> <i class="ms-1 fa fa-caret-down"
                                    aria-hidden="true"></i> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu4" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="TrabalhosPendentesCliente.php" style="color: cornflowerblue;"
                                        class="nav-link px-0"><i class="ms-3 fs-6 fa fa-unlock"></i> <span
                                            class="ms-1 d-none d-sm-inline">Pendentes</span></a>
                                </li>
                                <li>
                                    <a href="TrabalhosRealizadosCliente.php" style="color: cornflowerblue;"
                                        class="nav-link px-0"><i class="ms-3 fs-6 fa fa-lock"></i> <span
                                            class="ms-1 d-none d-sm-inline">Realizados</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            
    <div class="col py-3">
      <div class="container">
        <div class="card-body">
      <form method="post" action="../bd_conexao/editClipublico.php" id="form" name="form" enctype="multipart/form-data">
        <h3 style="padding-bottom: 2%; padding-top: 10%; font-family: Arial, Helvetica, sans-serif;">Dados Públicos</h3>
        <div class="row">
          <div class="col-md-5">
          <div>
                    <img id="preview" name="preview" src="<?php echo '../cliente/perfil/'.$perfil; ?>" class="img-fluid" alt="user" 
                    style="width: 150px; height: 150px; object-fit: cover; margin-top: 3%; margin-bottom: 20%; border-radius: 50%; position: relative;">
                    <label for="perfil"><img src="../../img/camera.png" class="img-fluid" alt="user" style="width: 65px; position: absolute; margin-top: 1%; margin-bottom: 50%; right: 46%;" ></label>
                            <input type="file" name="perfil" id="perfil" accept=".png, .jpg, .jpeg, .svg" onchange="loadFile(event)"
                            style="display: none;"/>
                        </div>
            <input type="hidden" class="form-control" name="foto_perfil" id="foto_perfil" value="<?php echo $perfil; ?>" />
          </div>
          <div class="col-md-7">
            <div class="form-group">
              <label class="label" for="Nome" style="margin-left: 3%;">Nome:</label>
              <input type="text" class="form-control" required name="nome" id="nome" value="<?php echo $nome ?>" />
            </div>
            <div class="form-group">
              <label class="label" for="Email" style="margin-left: 3%;">Email:</label>
              <input type="email" class="form-control" required name="email" id="email" value="<?php echo $email ?>" />
            </div>
          </div>
          <div class="col-md-12" style="padding-top: 4%;">
            <div class="form-group1">
              <label class="label" for="Biografia" style="margin-left: 3%;">Biografia:</label>
              <textarea class="form-control" id="biografia" name="biografia" rows="3"><?php echo $biografia ?></textarea>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="label" for="Genero" style="margin-left: 3%;">Gênero:</label>
              <select class="form-select" required name="genero" id="genero">
                <option value="<?php echo $genero ?>"><?php echo $genero ?> (selecionado)</option>
                <option value="feminino">Feminino</option>
                <option value="masculino">Masculino</option>
                <option value="nao-binario">Não-Binário</option>
                <option value="nao-infomar">Prefiro não informar</option>
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="label" for="Telefone" style="margin-left: 3%;">Celular:</label>
              <input type="tel" class="form-control" required name="telefone" id="telefone" value="<?php echo $tel ?>" />
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="label" for="LinkWhats" style="margin-left: 3%;">Link WhatsApp:</label>
              <input type="url" class="form-control" required name="link" id="link" disabled value="<?php echo $link ?>" />
            </div>
          </div>
        </div>
        <br>
        <div class="buttons">
          <button type="submit" id="btnCancelar" class="btnCancelar">
            Cancelar
          </button>
          <button type="submit" id="btnSalvar" class="btnSalvar">
            Salvar
          </button>
        </div>
        <br><br>
      </form>
    </div>
  </div>

  <script>
                var loadFile = function(event) {
                    var output = document.getElementById('preview');
                    output.src = URL.createObjectURL(event.target.files[0]);
                    output.onload = function() {
                    URL.revokeObjectURL(output.src)
                    }
                };
        </script>

</body>

</html>
