<?php
include ('../bd_conexao/conexao.php');

if(isset($_POST['email_prof']) || isset($_POST['senha'])){
  if(strlen($_POST['email_prof']) == 0) {
    echo "Preencha seu e-mail";
  } else if(strlen($_POST['senha']) == 0){
    echo "Preencha sua senha";
  } else {
    $email = $con->real_escape_string($_POST['email_prof']);
    $senha = $con->real_escape_string($_POST['senha']);

    //LOGIN ADM
    $adm = "SELECT * FROM `cadastroprofissional` WHERE email_prof = 'mailstreamlineserver@gmail.com' and ativo = '0'";
    $adm_query = $con->query($adm) or die("Falha no SQL: ".$con->error);
    $admLogin = $adm_query->num_rows;

    if($admLogin == 1){
      $usuario = $adm_query->fetch_assoc();
      $senha_banco = $usuario['senha'];

      if(password_verify($senha, $senha_banco)){
        
        if(!isset($_SESSION)) {
          session_start();
          header("Location: ../Admin/telaAdm.php");  //redirecionar o adm logado
          $_SESSION['token'] = $usuario['token']; //Variável Global
        }
      }
    }
    //FIM LOGIN ADM

              $sql = "SELECT * FROM `cadastroprofissional` WHERE email_prof = '$email' and ativo = '1'";
              $sql_query = $con->query($sql) or die("Falha no SQL: ".$con->error);

              $quantidade = $sql_query->num_rows;
              if($quantidade == 1){
                $usuario = $sql_query->fetch_assoc();
                $senha_banco = $usuario['senha'];

                if(password_verify($senha, $senha_banco)){
                  
                  if(!isset($_SESSION)) {
                    session_start();
                  }
            
                  $_SESSION['Id_prof'] = $usuario['Id_prof']; //Variável Global
                  $_SESSION['email_prof'] = $usuario['email_prof'];
                  $id_prof = $_SESSION['Id_prof'];
            
                  $suspensao = mysqli_query ($con, "SELECT Id_prof, COUNT(Id_prof) FROM `denuncia_cli` 
                  WHERE Id_prof = $id_prof group by Id_prof HAVING COUNT(Id_prof) = 3"); // Consulta da tabela denúncia
                  
                  $quant = $suspensao->num_rows;
                  if($quant == 1){
                    echo "<script>alert('Você está Suspenso!')</script>";
                  }else{
                  session_start();
                  header("Location: DadosPublicosAutonomo.php");  //redirecionar o user logado
                  }
                }else{
                echo "<script>alert('E-mail ou Senha incorretos!')</script>";
                }
              }
            }
 }


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
  <link rel="stylesheet" href="../../css/formulario.css" />
  <link rel="stylesheet" href="../../css/navbar.css" />
  <link rel="stylesheet" href="../../css/login.css" />
  <link href="../../node_modules/jquery/dist/jquery.js" />
  <script src="../../node_modules/bootstrap/dist/js/bootstrap.js"></script>
  <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="../../js/function.js"></script>
  <title>Login Autonomo</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-faded" style="background-color: #f2f2f2;">
    <div class="container-fluid">
      <a class="navbar-brand">StreamLine</a>
      <button class="navbar-toggler first-button" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <div class="animated-icon1"><span></span><span></span><span></span><span></span></div>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
          <img class="home" src="../../img/casa.png" alt="home" style="height: 20px; width: 20px; margin-top: 8px" />
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../Home.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="cadastroAutonomo.php">Cadastrar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" aria-current="page" href="#">Entrar</a>
          </li>
          <img class="user" src="../../img/user.svg" alt="vertical-line" style="height: 25px; margin-top: 8px; pointer-events: none; opacity: 0.2;" />
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="card">
      <h3 class="card-title">Logar como Autônomo</h3>
      <p class="card-text">
        Conecte-se gratuitamente com diversos clientes
      </p>
      <div class="card-body">
        <form method="post" action="" id="form" name="form">
          <div class="form-group">
            <label class="label" for="Email">Email:</label>
            <input type="email" class="form-control" required name="email_prof" id="email_prof" placeholder="email12345@email.com" />
          </div>
          <div class="form-group">
            <label class="label" for="Senha">Senha:</label>
            <input type="password" class="form-control" required name="senha" id="senha" placeholder="••••••••" />
            <input type="checkbox" onclick="Mostrar()" style="margin-top: 5%;"> Mostrar Senha</input>
          </div>
          <div class="buttons">
            <button type="submit" formaction="" id="btnPress" class="btnPress" style="margin-top: 10%;">
              Entrar
            </button>
            <p class="texto"> <a href="../email/recuperarsenhaAuto.php">Esqueceu a senha?</a></p>
            <p class="texto">Não possui cadastro? <a href="cadastroAutonomo.php">Cadastre-se agora</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
  <footer>
    <p>© 2022 StreamLine - LMNNY</p>
  </footer>

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

</body>

</html>
