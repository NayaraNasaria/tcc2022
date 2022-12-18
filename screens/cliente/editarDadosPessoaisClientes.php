<?php
session_start();
include('../protect/ProtectCli.php');
include('../bd_conexao/conexao.php');


$id_cli = $_SESSION['Id_cli'];
$cons = "SELECT * FROM `cadastrocliente` WHERE Id_cli = $id_cli;";
$consulta = $con->query($cons);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="format-detection" content="telephone=no" />
  <meta name="msapplication-tap-highlight" content="no" />
  <meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover" />
  <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.css" />
  <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../css/perfilAutonomo.css" />
  <link rel="stylesheet" href="../../css/navbar.css" />
  <link href="../../node_modules/jquery/dist/jquery.js" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" />
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
          <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-2 d-none d-sm-inline" style="font-weight: bold; color: #f2f2f2">StreamLine</span>
          </a>
          <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <form action="busca/buscaAutonomo.php" method="GET" name="buscaAutonomo">
              <div class="search-boxData">
                <input type="text" class="search-textData" placeholder="Buscar">
                <a href="javascript:buscaAutonomo.submit()" class="search-btnData">
                  <img src="../../img/search.svg" alt="lupa" height="20" width="20" style="margin-right: 5px;">
                </a>
              </div>
            </form>
            <li class="nav-item">
              <a href="InicialClientesTrabPendentes.php" class="nav-link homenav align-middle px-0 pt-0" style="color: #BF9052">
                <i class="ms-2 fs-4 fa fa-home"></i> <span class="ms-1 d-none d-sm-inline"
                  style="font-weight: bold; font-size: 17px;">Home</span>
              </a>
            </li>
            <li>
              <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle" style="color: #BF9052;font-weight:bold;">
                <i class="ms-2 fs-5 fa fa-user"></i> <span class="ms-1 d-none d-sm-inline">Perfil</span>
                <i class="ms-1 fa fa-caret-down" aria-hidden="true"></i> </a>
              <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                <li class="w-100">
                  <a href="dadosPessoaisClientes.php" style="color: cornflowerblue;" class="nav-link px-0"><i
                      class="ms-3 fs-6 fa fa-user"></i> <span class="ms-1 d-none d-sm-inline">Dados pessoais</span></a>
                </li>
                <li>
                  <a href="dadosPublicosClientes.php" style="color: cornflowerblue;" class="nav-link px-0"><i
                      class="ms-3 fs-6 fa fa-users"></i> <span class="ms-1 d-none d-sm-inline">Dados públicos</span></a>
                </li>
              </ul>
            </li>
            <li>
              <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle" style="color: #BF9052;font-weight:bold;">
                <i class="ms-2 fs-5 fa fa-briefcase"></i> <span class="ms-1 d-none d-sm-inline">Trabalhos</span> <i
                  class="ms-1 fa fa-caret-down" aria-hidden="true"></i> </a>
              <ul class="collapse nav flex-column ms-1" id="submenu4" data-bs-parent="#menu">
                <li class="w-100">
                  <a href="TrabalhosPendentesCliente.php" style="color: cornflowerblue;" class="nav-link px-0"><i
                      class="ms-3 fs-6 fa fa-unlock"></i> <span class="ms-1 d-none d-sm-inline">Pendentes</span></a>
                </li>
                <li>
                  <a href="TrabalhosRealizadosCliente.php" style="color: cornflowerblue;" class="nav-link px-0"><i
                      class="ms-3 fs-6 fa fa-lock"></i> <span class="ms-1 d-none d-sm-inline">Realizados</span></a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <div class="col py-3">
        <div class="container">
          <div class="card-body">
            <?php while ($dado = mysqli_fetch_assoc($consulta)) { ?>
            <form method="post" action="../bd_conexao/editCliPessoais.php" id="form" name="form">
              <h3 style="padding-bottom: 2%;font-weight:bold;">Dados
                Pessoais</h3>
              <div class="row">
                <div class="col-md-5">
                  <center>
                    <img src="<?php echo 'perfil/' . $dado['foto_perfil']; ?>" class="img-fluid" alt="user"
                      style="width: 150px; height: 150px; object-fit: cover; margin-top: 3%; margin-bottom: 5%; border-radius: 50%;">
                  </center>
                </div>
                <div class="col-md-7">
                  <div class="form-group">
                    <label class="label" for="Email" style="margin-left: 3%;">Email:</label>
                    <input type="email" class="form-control" name="email" id="Email"
                      value="<?php echo $dado['email_cli']; ?>"
                       />
                  </div>
                  <div class="form-group">
                    <label class="label" for="Senha" style="margin-left: 3%;">Senha:</label>
                    <input type="password" class="form-control" name="senha" id="senha"
                      value="" placeholder="Digite a Nova Senha"
                       />
                       <input type="checkbox" onclick="Mostrar()"> Mostrar Senha</input>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="label" for="Nome" style="margin-left: 3%;">Nome:</label>
                    <input type="text" class="form-control" name="nome" id="Nome"
                      value="<?php echo $dado['nome_cli']; ?>"
                       />
                  </div>
                  <div class="form-group">
                    <label class="label" for="Cep" style="margin-left: 3%;">CEP:</label>
                    <input type="text" class="form-control" required name="cep" id="Cep"
                      value="<?php echo $dado['cep']; ?>"
                       />
                  </div>
                </div>
                <div class="form-grouprow">
                  <div class="form-col" style="width: 65%;">
                    <label class="label" for="Cidade" style="margin-left: 4%;">Cidade:</label>
                    <input type="text" class="form-control" required name="cidade" id="Cidade"
                      value="<?php echo $dado['cidade']; ?>"
                       />
                  </div>
                  <div class="form-col1" style="width: 30%;">
                    <label class="label" for="Estado" style="margin-left: 8%;">Estado:</label>
                    <input type="text" class="form-control" required name="estado" id="Estado"
                      value="<?php echo $dado['estado']; ?>"
                       />
                  </div>
                </div>

                <div class="form-grouprow">
                  <div class="form-col" style="width: 30%;">
                    <label class="label" for="Numero" style="margin-left: 9%;">N°:</label>
                    <input type="text" class="form-control" required name="numero_casa" id="Numero"
                      value="<?php echo $dado['numero_casa']; ?>"
                       />
                  </div>
                  <div class="form-col1" style="width: 65%;">
                    <label class="label" for="Complemento" style="margin-left: 4%;">Complemento:</label>
                    <input type="text" class="form-control" name="complemento" id="Complemento"
                      value="<?php echo $dado['complemento']; ?>"
                       />
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
            <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
            <script type="text/javascript">
              $("#cep").mask("00000-000");
            </script>
            <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
            <script>
              // Registra o evento blur do campo "cep", ou seja, a pesquisa será feita
              // quando o usuário sair do campo "cep"

              window.onload = (function () {
                // Remove tudo o que não é número para fazer a pesquisa
                var cep = this.value.replace(/[^0-9]/, "");

                // Validação do CEP; caso o CEP não possua 8 números, então cancela
                // a consulta
                if (cep.length != 8) {
                  return false;
                }

                // A url de pesquisa consiste no endereço do webservice + o cep que
                // o usuário informou + o tipo de retorno desejado (entre "json",
                // "jsonp", "xml", "piped" ou "querty")
                var url = "https://viacep.com.br/ws/" + cep + "/json/";

                // Faz a pesquisa do CEP, tratando o retorno com try/catch para que
                // caso ocorra algum erro (o cep pode não existir, por exemplo) a
                // usabilidade não seja afetada, assim o usuário pode continuar//
                // preenchendo os campos normalmente
                $.getJSON(url, function (resposta) {
                  try {
                    // Preenche os campos de acordo com o retorno da pesquisa
                    $("#estado").val(resposta.uf);
                    $("#cidade").val(resposta.localidade);
                    $("#bairro").val(resposta.bairro);
                    $("#rua").val(resposta.logradouro);
                  } catch (ex) { }
                  $("#numero").focus();
                });
              });
            </script>
            <?php } ?>

            <script>
                             // Mostrar senha mudando o tipo de password para texto
                          function Mostrar() {
                            var senha = document.getElementById("senha");
                            
                            if (senha.type === "password") {
                                senha.type = "text";
                            }
                            else {
                                senha.type = "password";
                            }
                          }
                        </script>
          </div>
        </div>
      </div>
</body>

</html>
