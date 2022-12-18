<?php
session_start();
include('../protect/ProtectCli.php');
include('../bd_conexao/conexao.php');

$id_cli = $_SESSION['Id_cli'];
$autonomo = $_POST['autonomo']; 

$cons = "SELECT P.Id_prof, P.nome_prof, P.biografia, P.genero, P.email_prof,
P.link, P.data_nascimento, P.cidade, P.estado, P.foto_perfil, P.contato, P.data_cadProf,
P.profissao, P.esp_exp, P.preco_fixo,
S.data_contratacao, S.quant_horas FROM servico S 
INNER JOIN cadastroprofissional P ON S.Id_prof = P.Id_prof
 WHERE S.Id_prof = $autonomo;";
$consulta = $con->query($cons);


if($consulta->num_rows > 0){
  while($dados = mysqli_fetch_assoc($consulta)){
    $id_prof = $dados['Id_prof'];
    $nome = $dados['nome_prof']; 
    $bio = $dados['biografia'];
    $genero = $dados['genero'];
    $email = $dados['email_prof'];
    $link = $dados['link'];
    $nascimento = $dados['data_nascimento'];
    $contato = $dados['contato'];
    $dataCadastro = $dados['data_cadProf'];
    $estado = $dados['estado'];
    $cidade = $dados['cidade'];
    $perfil = $dados['foto_perfil'];
    $profissao = $dados['profissao'];
    $esp_exp = $dados['esp_exp'];
    $preco = $dados['preco_fixo'];
    $data_contratacao = $dados['data_contratacao'];
    $quant_horas = $dados['quant_horas'];
  }
}else{
  // header('Location: contratacaoAutonomoCliente.php');
}

//AVALIAÇÕES
$subconsulta = "SELECT AVG(DISTINCT Avaliacao_prof) as AvaliacaoProf FROM avaliacoesprofissional where Id_prof = $id_prof;";
$avaliacoes = $con->query($subconsulta);

while ($avali = mysqli_fetch_assoc($avaliacoes)) { 

  $aval_valor = $avali['AvaliacaoProf'];
}


// AVALIAÇÕES
$avaliacoes = "SELECT A.nome_cli, A.data_aval_prof, A.Comentario_prof, A.Avaliacao_prof,
C.foto_perfil, P.Id_prof
FROM avaliacoesprofissional A 
INNER JOIN cadastroprofissional P 
ON A.Id_prof = P.Id_prof
INNER JOIN cadastrocliente C 
ON A.Id_cli = C.Id_cli
 WHERE A.Id_prof = $id_prof LIMIT 0,1;";
 $aval = $con->query($avaliacoes);

//cálculo de idade
$nascimento = new DateTime($nascimento);
$data_hoje = new DateTime(date('Y-m-d'));
$idade = $data_hoje->diff($nascimento);

$data_atual = date('Y-m-d');
date_default_timezone_set('America/Sao_Paulo'); //converter para horário de Brasília
$horario_atual = date('H:i:s', time());

if (isset($_POST['btnPress'])) { 
  $sql = mysqli_query($con, "UPDATE `servico` SET  `hora_finalizacao`='$horario_atual' 
  WHERE Id_prof = '$id_prof' AND Id_cli ='$id_cli'");

if($sql >= 1){
  $insertAval = mysqli_query ($con, "INSERT INTO `avaliacoesprofissional`(`Id_aval_prof`, `Id_prof`, 
  `Id_cli`, `nome_prof`, `nome_cli`, `data_aval_prof`, `Comentario_prof`, `Avaliacao_prof`) VALUES 
  ('','$id_prof','$id_cli','$nome','','','','')");

if($insertAval >= 1){
  header('Location: inicialClientesTrabPendentes.php'); }else{}
}else{}
}else{}
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
  <title>Finalizar Serviço</title>
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
              <img class="user" src="../../img/user.svg" alt="user" style="height: 25px; margin-right: 2px;" />
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
    <div class="col-sm-5" style="margin-bottom: 5%;">
      <h2 style="
          font-family: Playfair Display;
          font-weight: 500;
          margin: 0;
          text-align: center;
        ">
        Perfis de Autônomos
      </h2>
    </div>
    <div class="card">
      <div class="card-body">
          <div class="row">
            <div class="col-sm-5">
            <form method="post" id="form" name="form">
              <div class="estrelas">
              <label for="cm_star-1"><?php echo substr($aval_valor,0,3); ?> <i class="fa"></i></label>
              </div>
              <center>
                <img src="<?php echo '../autonomo/perfil/' . $perfil ?>" class="img-fluid" alt="user" style="
                      width: 150px; height: 150px; object-fit: cover;
                      background: #182b3d;
                      margin-top: 3%;
                      margin-bottom: 5%;
                      border-radius: 10px;
                    " />
              </center>
            </div>
            <div class="col-md-6" id="infocima" style="margin: 0;">
              <div class="form-group">
                <label class="label" for="Nome" style="margin-left: 3%;">Nome do Profissional:</label>
                <input type="text" class="form-control" required name="nomedoprof" id="Nome" value="<?php echo $nome; ?>" readonly />
              </div>
              <div class="form-group">
                <label class="label" for="Biografia" style="margin-left: 3%">Biografia:</label>
                <textarea class="form-control" id="Biografia" rows="3" disabled><?php echo $bio; ?></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="label" for="Gênero" style="margin-left: 3%">Gênero:</label>
                <input type="text" class="form-control" required name="Gênero" id="Gênero" value="<?php echo $genero; ?>" disabled />
              </div>
              <div class="form-group">
                <label class="label" for="Email" style="margin-left: 3%">Email:</label>
                <input type="text" class="form-control" required name="Email" id="Email" value="<?php echo $email; ?>" disabled />
              </div>
              <div class="form-group">
                <label class="label" for="Telefone" style="margin-left: 3%">Telefone:</label>
                <input type="text" class="form-control" required name="Telefone" id="Telefone" value="<?php echo $contato; ?>" disabled />
              </div>
              <div class="form-group">
                <label class="label" for="Link" style="margin-left: 3%">Whatsapp:</label>
                <a class="search-btn" required name="Link" id="Link" disabled href="<?php echo $link; ?>">
                  <br>
                  <img src="../../img/whatsapp.png" alt="whatsapp" height="40" width="40" style="margin-right: 30px;">

                </a>
              </div>
              <div class="form-group">
                <label class="label" for="DataCadastro" style="margin-left: 3%">Data de Cadastro:</label>
                <input class="form-control" required name="DataCadastro" id="DataCadastro" value="<?php $data = $dataCadastro;
                                                                                                  echo date_format(new DateTime($data), 'd/m/Y'); ?>" disabled />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="label" for="Prof" style="margin-left: 3%">Profissão Requisitada:</label>
                <input type="text" class="form-control" required name="Prof" id="Prof" value="<?php echo $profissao; ?>" disabled />
              </div>
              <div class="form-group">
                <label class="label" for="Esp" style="margin-left: 3%">Especialidade:</label>
                <input type="text" class="form-control" required name="Esp" id="Esp" value="<?php echo $esp_exp; ?>" disabled />
              </div>
              <div class="form-group">
                <label class="label" for="Preco" style="margin-left: 3%">Preço base:</label>
                <input type="text" class="form-control" required name="Preco" id="Preco" value="<?php echo $preco; ?>" disabled />
              </div>
              <div class="form-group">
                <label class="label" for="Qts" style="margin-left: 3%">Tempo de serviço:</label>
                <input type="text" class="form-control" required name="Qts" id="Qts" value="<?php echo $quant_horas; ?>" disabled />
              </div>
              <div class="form-group">
                <label class="label" for="Idade" style="margin-left: 3%">Idade:</label>
                <input type="text" class="form-control" required name="Idade" id="Idade" value="<?php echo $idade->y . " anos"; ?>" disabled />
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label class="label" for="DataContrat" style="margin-left: 3%">Data da Contratação:</label>
                <input type="text" class="form-control" required name="DataContrat" id="DataContrat" value="<?php $data = $data_contratacao;
                                                                                                            echo date_format(new DateTime($data_contratacao), 'd/m/Y'); ?>" disabled />
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label class="label" for="Cidade" style="margin-left: 3%">Cidade:</label>
                <input type="text" class="form-control" required name="Cidade" id="Cidade" value="<?php echo $cidade; ?>" disabled />
              </div>
            </div>
            
            <div class="col-md-4" style="padding-top: 10px">
              <div class="form-group">
                <label class="label" for="UF" style="margin-left: 3%">Estado:</label>
                <input type="text" class="form-control" required name="UF" id="UF" value="<?php echo $estado; ?>" disabled />
              </div>
            </div>
          </div>



          <!-- AVALIAÇÕES -->
         <?php 
              if ($aval->num_rows > 0) {
              while ($da = mysqli_fetch_assoc($aval)) { 
               //AVALIAÇÕES
            $id_prof = $da['Id_prof'];
            $subconsulta = "SELECT AVG(DISTINCT Avaliacao_prof) as AvaliacaoProf FROM avaliacoesprofissional where Id_prof = $id_prof;";
            $avaliacoes = $con->query($subconsulta);

            while ($avali = mysqli_fetch_assoc($avaliacoes)) { 

              $aval_val = $avali['AvaliacaoProf'];
            }
                ?>
          <section id="avaliações">
            <div id="carousel" class="carousel slide w-100" data-bs-ride="carousel" data-interval = "0">
            
              <div class="carousel-inner w-100" style="padding-top: 8%">
              <button type="submit" 
                  style="text-align: center; margin: 10px; padding: 10px"
                          class='btn pull-right'
                          formaction="TodasAvaliacoesAutonomo.php" id="btnEntrar">
                      Ver Mais
                    </button>
                    <br>

                <div class="col-sm-5">
                  <h4 class="d-block" style="
                          color: black;
                          text-align: center;
                          font-family: Playfair Display;
                          margin: 0;
                        ">
                    Avaliações:
                  </h4>
  
                </div>
                <div class="carousel-item active">
                  <div class="col-sm-8">
                    <div class="card-carousel" style="max-width: 700px; background-color: #AAAAAA;">
                      <div class="card-body">
                          <div class="row">
                            <div class="col-sm-4">
                              <div class="estrelas">
                              <label for="cm_star-1">  <?php echo substr($aval_val,0,3); ?>  <i class="fa"></i></label>
                              </div>
                              <center>
                                <img src="<?php echo '../autonomo/perfil/' . $da['foto_perfil']; ?>" class="img-fluid" alt="user" 
                                style="
                                        width: 150px; height: 150px; object-fit: cover;
                                        background: #182b3d;
                                        margin-top: 3%;
                                        margin-bottom: 5%;
                                        border-radius: 10px;
                                      " />
                              </center>
                            </div>
                            <div class="col" style="margin-top: 20px;">
                              <div class="form-group">
                                <label class="label" for="Nome" style="margin-left: 3%">Nome:</label>
                                <input type="text" class="form-control" required name="Nome" id="Nome" value="<?php echo $da['nome_prof']; ?>" disabled />
                              </div>
                            </div>
                            <input type="hidden" class="form-control" name="autonomo" id="autonomo" value="<?php echo $id_prof; ?>" />
                            <div class="col-md-12">
                              <div class="form-group">
                                <label class="label" for="DataTrabalho" style="margin-left: 3%">Realização do Trabalho:</label>
                                <input type="text" class="form-control" required name="DataTrabalho" id="DataTrabalho" value="<?php $data = $da['data_aval_prof'];
                                                                                                                                echo date_format(new DateTime($data), 'd/m/Y'); ?>" disabled />
                              </div>
                            </div>
                            <div class="col-md-12" style="margin-bottom: 10px">
                              <div class="form-group">
                                <label class="label" for="Comentario" style="margin-left: 2%">Comentário:</label>
                                <textarea class="form-control" id="Comentario" rows="3" disabled><?php echo $da['Comentario_prof']; ?></textarea>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } 
            }else{ ?>
            <center>
              <br>
            <p>Não há Avaliações</p>
            </center>
            <?php   }
            ?>
          </section>
          <input type="text" class="form-control" name="autonomo" id="autonomo" value="<?php echo $id_prof; ?>" />

              <!-- FIM AVALIAÇÕES -->

          <div class="buttons">
            <button type="submit" id="btnEntrar" class="btnEntrar">
              Cancelar
            </button>

            <button type="submit" id="btnPress" name="btnPress" class="btnPress">
              Finalizar Serviço
            </button>

          </div>
        
      </div>
      </form>
    </div>
  </div>
  <footer>
    <p>© 2022 StreamLine - LMNNY</p>
  </footer>

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

</body>

</html>
