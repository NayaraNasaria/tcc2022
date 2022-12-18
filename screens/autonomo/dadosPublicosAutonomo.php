<?php
session_start();
include('../protect/Protect.php'); // inicia a sessão e protege o login
include('../bd_conexao/conexao.php');

$id_prof = $_SESSION['Id_prof'];
$cons = "SELECT * FROM `cadastroprofissional` WHERE Id_prof = $id_prof;";
$consulta = $con->query($cons);
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
    <title>Perfil Autônomo</title>
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
                            <a href="InicialAutonomoTrabPendentes.php" class="nav-link homenav align-middle px-0 pt-0"
                                style="color: #BF9052">
                                <i class="ms-2 fs-4 fa fa-home"></i> <span class="ms-1 d-none d-sm-inline"
                                    style="font-weight: bold; font-size: 17px;">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle"
                                style="color: #BF9052">
                                <i class="ms-2 fs-5 fa fa-user"></i> <span class="ms-1 d-none d-sm-inline" style="font-weight: bold;">Perfil</span>
                                <i class="ms-1 fa fa-caret-down" aria-hidden="true"></i> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="dadosPessoaisAutonomo.php" style="color: cornflowerblue;"
                                        class="nav-link px-0"><i class="ms-3 fs-6 fa fa-user"></i> <span
                                            class="ms-1 d-none d-sm-inline">Dados pessoais</span></a>
                                </li>
                                <li>
                                    <a href="dadosPublicosAutonomo.php" style="color: cornflowerblue;"
                                        class="nav-link px-0"><i class="ms-3 fs-6 fa fa-users"></i> <span
                                            class="ms-1 d-none d-sm-inline">Dados públicos</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle"
                                style="color: #BF9052">
                                <i class="ms-2 fs-5 fa fa-briefcase"></i> <span
                                    class="ms-1 d-none d-sm-inline" style="font-weight: bold;">Trabalhos</span> <i class="ms-1 fa fa-caret-down"
                                    aria-hidden="true"></i> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu4" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="TrabalhosPendentes.php" style="color: cornflowerblue;"
                                        class="nav-link px-0"><i class="ms-3 fs-6 fa fa-unlock"></i> <span
                                            class="ms-1 d-none d-sm-inline">Pendentes</span></a>
                                </li>
                                <li>
                                    <a href="TrabalhosRealizados.php" style="color: cornflowerblue;"
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
                        <?php while ($dado = mysqli_fetch_assoc($consulta)) { ?>
                        <form method="post" action="" id="form" name="form">
                            <h3
                                style="padding-bottom: 2%; padding-top: 10%; font-family: Arial, Helvetica, sans-serif;">
                                Dados
                                Públicos</h3>
                            <div class="row">
                                <div class="col-md-5">
                                    <center>
                                        <img src="<?php echo '../autonomo/perfil/' . $dado['foto_perfil']; ?>"
                                            class="img-fluid" alt="user"
                                            style="width: 150px; height: 150px; object-fit: cover;  margin-top: 3%; margin-bottom: 5%; border-radius: 50%;">
                                    </center>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="label" for="Nome" style="margin-left: 3%;">Nome:</label>
                                        <input type="text" class="form-control" required name="Nome" id="nome_prof"
                                            disabled value="<?php echo $dado['nome_prof']; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label class="label" for="Email" style="margin-left: 3%;">Email:</label>
                                        <input type="email" class="form-control" required name="Email" id="email_prof"
                                            disabled value="<?php echo $dado['email_prof']; ?>" />
                                    </div>
                                </div>
                                <div class="col-md-12" style="padding-top: 4%;">
                                    <div class="form-group1">
                                        <label class="label" for="Biografia" style="margin-left: 3%;">Biografia:</label>
                                        <textarea class="form-control" id="biografia" rows="3"
                                            disabled><?php echo $dado['biografia']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="label" for="Profissao" style="margin-left: 3%;">Profissão:</label>
                                        <input type="text" class="form-control" required name="Profissao" id="profissao"
                                            disabled value="<?php echo $dado['profissao']; ?>" />
                                    </div>
                                </div>
                                <div class="form-grouprow">
                                    <div class="form-col" style="width: 45%;">
                                        <label class="label" for="TempExp" style="margin-left: 6%;">Tempo de
                                            Experiência:</label>
                                        <input type="number" class="form-control" required name="TempExp" id="tempo_exp"
                                            disabled value="<?php echo $dado['tempo_exp']; ?>" />
                                    </div>
                                    <div class="form-col1" style="padding-top: 0.5%; width: 50%;">
                                        <label class="label" for="SelectTempExp"></label>
                                        <input type="text" class="form-control" required name="SelectTempExp"
                                            id="espTempo" disabled value="<?php echo $dado['espTempo']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="label" for="Genero" style="margin-left: 3%;">Gênero:</label>
                                        <input type="text" class="form-control" required name="Genero" id="genero"
                                            disabled value="<?php echo $dado['genero']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="label" for="contato" style="margin-left: 3%;">Celular:</label>
                                        <input type="tel" class="form-control" required name="contato" id="contato"
                                            disabled value="<?php echo $dado['contato']; ?>" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="label" for="LinkWhats" style="margin-left: 3%;">Link
                                            WhatsApp:</label>
                                        <input type="url" class="form-control" required name="LinkWhats" id="link"
                                            disabled value="<?php echo $dado['link']; ?>" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="label" for="Preco" style="margin-left: 3%;">Preço base:</label>
                                        <input type="text" class="form-control" required name="Preco" id="preco_fixo"
                                            disabled value="<?php echo $dado['preco_fixo']; ?> R$" />
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="buttons">
                                <a href="editarDadosPublicosAutonomo.php" id="btnEditar" class="btn btnEditar">
                                    Editar Informações
                                </a>
                            </div>
                            <br><br>
                        </form>
                        <?php } ?>
                    </div>
                </div>

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

                    $('#contato').mask(SPMaskBehavior, spOptions);
                </script>
</body>

</html>