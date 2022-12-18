<?php
session_start();
include('../bd_conexao/conexao.php');
include('../protect/ProtectCli.php');

$autonomo = $_POST['autonomo']; 
$esp = $_POST['esp'];
$quant_horas = $_POST['quant_horas'];  
$preco = $_POST['preco'];  
$nome= $_POST['nome'];  
$tel = $_POST['telefone'];  
$profissao = $_POST['area'];  
$orcamento = $preco * $quant_horas;

?>


<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta
      name="viewport"
      content="initial-scale=1, width=device-width, viewport-fit=cover"
    />

    <link
      rel="stylesheet"
      type="text/css"
      href="../../bootstrap/css/bootstrap.css"
    />
    <link rel="stylesheet" href="../../css/trabalhos.css" />
    <link rel="stylesheet" href="../../css/navbarHome.css" />
    <script src="../../js/jquery.js"></script>
    <script src="../../bootstrap/js/bootstrap.js"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css"
    />
    <script type="text/javascript" src="../../js/function.js"></script>
    <title>Contratação Orçamentária</title>
  </head>

  <body>
    <nav
      class="navbar navbar-expand-lg bg-faded"
      style="background-color: #f2f2f2"
    >
      <div class="container-fluid">
        <a class="navbar-brand">StreamLine</a>
        <button
          class="navbar-toggler first-button"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <div class="animated-icon1">
            <span></span><span></span><span></span><span></span>
          </div>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item dropdown">
              <a class="nav-link active dropdown-toggle" id="navbarDropdown">
                <img
                  class="user"
                  src="../../img/user.svg"
                  alt="user"
                  style="height: 25px; margin-right: 2px"
                />
                Perfil
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <div
                  class="dropdown-divider"
                  style="width: 60%; background-color: black"
                ></div>
                <li><a class="dropdown-item" href="#">ᐅ Minha Área</a></li>
                <li><a class="dropdown-item" href="#">ᐅ Trabalhos</a></li>
                <li><a class="dropdown-item" href="../protect/logout.php">Sair</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div
      class="container container-fluid"
      style="background-color: #f2f2f2; padding-top: 3.5%; min-height: 1000px"
    >
      <div class="row">
        <div class="col-sm-6" style="margin-bottom: 5%">
          <h2
            style="
              font-family: Playfair Display;
              font-weight: 500;
              margin: 0;
              text-align: center;
            "
          >
            Perfil de Profissional
          </h2>
        </div>
        <div class="col-sm-5">
          <a href="Home.html"
            ><button type="button" id="btnVoltar" class="btnVoltar">
              Voltar
            </button></a
          >
        </div>
      </div>
      <div class="card">
        <div class="card-body">

          <form method="post" action="ContratAutonomoFinal.php" id="form" name="form">
            <div class="row">
            <input type="hidden" class="form-control" name="autonomo" id="autonomo" value="<?php echo $autonomo;?>" />
              <div class="col-md-6" id="infocima" style="margin: 0">
                <div class="form-group">
                  <label class="label" for="Nome" style="margin-left: 3%"
                    >Nome do Profissional:</label
                  >
                  <input
                    type="text"
                    class="form-control"
                    required
                    name="nome"
                    id="nome"
                    value="<?php echo $nome; ?>"
                    readonly
                  />
                </div>
                <div class="form-group">
                  <label class="label" for="Telefone" style="margin-left: 3%"
                    >Telefone:</label
                  >
                  <input
                    type="text"
                    class="form-control"
                    required
                    name="telefone"
                    id="telefone"
                    value="<?php echo $tel; ?>"
                    readonly
                  />
                </div>
                <div class="form-group">
                  <label class="label" for="Preco" style="margin-left: 3%"
                    >Preco Fixo por Hora:</label
                  >
                  <input
                    type="text"
                    class="form-control"
                    required
                    name="preco"
                    id="preco"
                    value="<?php echo $preco; ?>"
                    readonly
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="label" for="Prof" style="margin-left: 3%"
                    >Profissão:</label
                  >
                  <input
                    type="text"
                    class="form-control"
                    required
                    name="area"
                    id="area"
                    value="<?php echo $profissao; ?>"
                    readonly
                  />
                </div>
                <div class="form-group">
                  <label class="label" for="esp"
                    >Especificações:</label
                  >
                  <input
                    type="text"
                    class="form-control"
                    multiple="multiple"
                    name="esp"
                    value="<?php echo $esp; ?>"
                    readonly
                    id="esp"
                  />
                </div>
                <div class="form-group">
                  <label class="label" for="QtsHora" style="margin-left: 3%"
                    >Quantidade de Horas:</label
                  >
                  <input
                    type="text"
                    class="form-control"
                    readonly
                    value="<?php echo $quant_horas; ?>"
                    name="quant_horas"
                    id="quant_horas"
                  />
                </div>
              </div>
              <center>
              
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="label" for="Orcamento" style="margin-left: 3%"
                    >Orçamento:</label
                  >
                  <input
                    type="text"
                    class="form-control"
                    required
                    name="orcamento"
                    id="orcamento"
                    value="<?php echo $orcamento; ?>"
                    readonly
                  />
                </div>
              </div>
            </center>
            </div>
            <div class="buttons">
              <button type="submit" id="btnEntrar" class="btnEntrar">
                Cancelar
              </button>
              <button
                type="submit"
                id="btnPress"
                class="btnPress"
              >
                Realizar Orçamento
              </button>
            </div>
          </form>
          <link
            href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css"
            rel="stylesheet"
          />

          <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
          <script>
            $(function () {
              $(".hidden").hide();

              $("select[name=esp]").html($("select.esp-a1").html());

              $("select[name=area]").change(function () {
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
