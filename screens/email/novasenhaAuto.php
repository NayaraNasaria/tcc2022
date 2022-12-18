<?php
include("../bd_conexao/conexao.php");

if (isset($_POST['btnPress'])) {

    $cod = $con->escape_string($_POST['codigo']);
    $novasenha = $con->escape_string($_POST['senha']);
    $confirmarsenha = $con->escape_string($_POST['newsenha']);

    $sql = "SELECT senha FROM `cadastroprofissional` WHERE senha = '$cod'";
    $sql_query = $con->query($sql) or die("Falha no SQL: " . $con->error);

    while($dados = mysqli_fetch_assoc($sql_query)){
        $codigo = $dados['senha'];  }

        if($codigo == $cod){
            if ($novasenha == $confirmarsenha) {

                $newsenha = password_hash($novasenha, PASSWORD_DEFAULT);

                $update = "UPDATE `cadastroprofissional` SET `senha`='$newsenha' WHERE senha = '$cod'";
                $update_query = $con->query($update) or die("Falha no SQL: " . $con->error);

                if ($update >= 1) {
                    header("Location: ../autonomo/loginAutonomo.php");
                } else {
                    echo mysqli_connect_error();
                }
            } else {
                echo "<script>alert('O código não está certo!');</script>";
                header("Location: recuperarsenha.php");
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="format-detection" content="telephone=no" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover" />
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/novasenha.css" />
    <link rel="stylesheet" href="../../css/navbar.css" />
    <link href="../node_modules/jquery/dist/jquery.js" />
    <script src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="../js/function.js"></script>
    <script src="../js/mostrarsenha.js"></script>
    <script src="../js/sweetalert2.js"></script>
    <title>Recuperar senha</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-faded" style="background-color: #182b3d;">
        <div class="container-fluid" style="padding-bottom: 30px;">
            <a class="navbar-brand" style="color: #f2f2f2;">StreamLine</a>
        </div>
    </nav>
    <div class="container">
        <div class="card-body">
            <h3 class="card-title" style="color:#f2f2f2;">Redefinição de senha</h3>
            <p class="card-text" style="min-width: 40px;">
                Por favor, insira o código de verificação enviado por e-mail e redefina uma nova senha.
            </p>
            <form method="post" action="" id="form" name="form" style="color: #f2f2f2;">
                <div class="form-group">
                    <input type="text" class="form-control" name="codigo" required id="codigo" placeholder="Código" />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" required name="newsenha" id="newsenha" placeholder="Nova senha" />
                    <!-- <img id="eye" onclick="eyeClick()" src="../../img/eye.png" width="20px" alt=""> -->
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" required name="senha" id="senha" placeholder="Repita a nova senha" />
                    <!-- <img id="eye" onclick="eyeClick()" src="../../img/eye.png" width="20px" alt=""> -->

                    <input type="checkbox" onclick="Mostrar()"> Mostrar Senha</input>
                </div>
                <div class="buttons">
                    <button type="submit" formaction="" name="btnPress" id="btnPress" class="btnPress" style="margin-top: 10%;">
                        Redefinir
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    // Mostrar senha mudando o tipo de password para texto
        function Mostrar() {
            var novasenha = document.getElementById("newsenha");
            var senha = document.getElementById("senha");
            
            if (senha.type === "password" || novasenha.type === "password") {
                senha.type = "text";
                novasenha.type = "text";
            }
            else {
                senha.type = "password";
                novasenha.type = "password";
            }
        }
        </script>

</body>

</html>
