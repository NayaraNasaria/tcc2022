<?php
session_start();
include('../protect/ProtectCli.php');
include('../bd_conexao/conexao.php');


$id_cli = $_SESSION['Id_cli'];
$autonomo = $_POST['autonomo']; 
$itens_pagina = 4; // quantidade por página
$pagina = 0; //página atual
$itens_carousel = 1;

//Consulta Avaliações
$avaliacoes = "SELECT A.Id_cli, A.nome_cli, A.data_aval_prof, A.Comentario_prof, A.Avaliacao_prof,
C.foto_perfil, P.Id_prof
FROM avaliacoesprofissional A 
INNER JOIN cadastroprofissional P 
ON A.Id_prof = P.Id_prof
INNER JOIN cadastrocliente C 
ON A.Id_cli = C.Id_cli
 WHERE A.Id_prof = $autonomo LIMIT $pagina, $itens_pagina;";
 $aval = $con->query($avaliacoes);
//Fim da Consulta

//PAGINAÇÃO
//quantidade de valores no banco de dados
$num_total = $con->query("SELECT A.Id_cli, A.nome_cli, A.data_aval_prof, A.Comentario_prof, A.Avaliacao_prof,
C.foto_perfil, P.Id_prof
FROM avaliacoesprofissional A 
INNER JOIN cadastroprofissional P 
ON A.Id_prof = P.Id_prof
INNER JOIN cadastrocliente C 
ON A.Id_cli = C.Id_cli
 WHERE A.Id_prof = $autonomo;")->num_rows;
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

    <link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="../../css/trabalhos.css" />
    <link rel="stylesheet" href="../../css/navbarHome.css" />
    <script src="../../js/jquery.js"></script>
    <script src="../../bootstrap/js/bootstrap.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" />
    <script type="text/javascript" src="../../js/function.js"></script>
    <title>Avaliações do Autônomo</title>
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
        </div>
    </nav>
    <div class="container container-fluid" style="background-color: #f2f2f2; padding-top: 3.5%; min-height: 800px">
        <div class="col-sm-5" style="margin-bottom: 5%;">
        <h2 style="
              font-family: Playfair Display;
              font-weight: 500;
              margin: 0;
              text-align: center;
            ">
            Avaliações do Autônomo
        </div>
        <div class="card">
            <div class="card-body">

            <?php while ($dado = mysqli_fetch_assoc($aval)) { 
            //AVALIAÇÕES
            $id_prof = $dado['Id_prof'];
            $subconsulta = "SELECT AVG(DISTINCT Avaliacao_prof) as AvaliacaoProf FROM avaliacoesprofissional where Id_prof = $id_prof;";
            $avaliacoes = $con->query($subconsulta);

            while ($avali = mysqli_fetch_assoc($avaliacoes)) { 

              $aval_valor = $avali['AvaliacaoProf'];
            }
            ?>  
            
          <form method="post" action="" id="form" name="form" >
            <div class="row">
              <div class="col">
              <center>
                <div class="estrelas">
                <label for="cm_star-1"><?php echo substr($aval_valor,0,3); ?>  <i class="fa"></i></label>
                </div>
                  <img src="<?php echo '../autonomo/perfil/' . $dado['foto_perfil'] ?>" class="img-fluid" alt="user" 
                  style="
                      width: 150px; height: 150px; object-fit: cover;
                      background: #182b3d;
                      margin-top: 3%;
                      margin-bottom: 5%;
                      border-radius: 10px;
                    " />
                </center>
              </div>
              <div class="form-group">
                  <label class="label" for="Nome" style="margin-left: 3%">Nome:</label>
                  <input type="text" class="form-control" required name="Nome" id="Nome" value="<?php echo $dado['nome_prof']; ?>" disabled />
                </div>
                <div class="form-group">
                  <label class="label" for="DataTrabalho" style="margin-left: 3%">Realização do Trabalho:</label>
                  <input type="text" class="form-control" required name="DataTrabalho" id="DataTrabalho" value="<?php $data = $dado['data_aval_prof'];
                                                                                                                                echo date_format(new DateTime($data), 'd/m/Y'); ?>" disabled />
                </div>
              <div class="form-group">
                <label class="label" for="Comentario" style="margin-left: 3%">Comentário:</label>
                <textarea class="form-control" id="Comentario" rows="3" disabled><?php echo $dado['Comentario_prof']; ?></textarea>
              </div>
            </div>
            <br>
          <br>
          <?php } ?>
            </div>
          </form>
      </div>
    </div>
    <div class="page-content page-container" id="page-content">
      <div class="padding">
        <div class="row container-row d-flex justify-content-center">
          <div class="col-md-5 col-sm-6 grid-margin stretch-card">
            <nav>
              <ul class="pagination d-flex justify-content-center flex-wrap pagination-rounded-flat pagination-success">
                <li class="page-item"><a class="page-link" href="TodasAvaliacoesAutonomo.php?pagina=0" data-abc="true"><i class="fa fa-angle-left"></i></a>
                </li>
                <!-- numeração -->
                <?php
                for ($i = 0; $i < $num_paginas; $i++) {
                  $estilo = "";
                  if ($pagina == $i) {
                    $estilo = "class=\"page-item active\"";
                ?>
                    <li class="page-item active"><a class="page-link" href="TodasAvaliacoesAutonomo.php?pagina=<?php echo $i; ?>" data-abc="true"><?php echo $i + 1; ?></a></li>
                    
                    <!-- Fim da numeração -->
                    <li class="page-item"><a class="page-link" href="TodasAvaliacoesAutonomo.php?pagina=<?php echo $num_paginas - 1; ?>" data-abc="true"><i class="fa fa-angle-right"></i></a></li>
                    <?php } ?>
                <?php } ?>
                  </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
    </div>
    <footer>
        <p>© 2022 StreamLine - LMNNY</p>
    </footer>
</body>

</html>
