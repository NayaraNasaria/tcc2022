<?php
include("../bd_conexao/conexao.php");


if (isset($_POST['btnPress'])) {

    $token = $con->escape_string($_POST['token']);

    $sql = "SELECT * FROM `cadastroprofissional` WHERE token = '$token'";
    $sql_query = $con->query($sql) or die("Falha no SQL: " . $con->error);

    $totalToken = mysqli_num_rows($sql_query);
        if($totalToken == 1){
                $up = "UPDATE `cadastroprofissional` SET `ativo`= '1' WHERE token = '$token'";
                $update_query = $con->query($up) or die("Falha no SQL: " . $con->error);

                if ($update_query >= 1) {

                    $aval = mysqli_query ($con, "INSERT INTO `avaliacoesprofissional`(`Id_aval_prof`, `Id_prof`, `Id_cli`, 
                    `nome_prof`, `nome_cli`, `data_aval_prof`, `Comentario_prof`, `Avaliacao_prof`) VALUES 
                    ('','1','1','Admin','Admin','2022-11-11','Bom Trabalho!','3')");

                    echo "<script>alert('Cadastro Concluído com sucesso!')</script>";
                    header("Location: ../autonomo/loginAutonomo.php");
                } else {
                }
            } else {
                echo "<script>alert('O código não está certo!\nPor favor, olhe o seu e-mail.');</script>";
                header("Location: confirmarCadAuto.php");
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
    <link rel="stylesheet" href="../../css/recuperarsenha.css" />
    <link rel="stylesheet" href="../../css/navbar.css" />
    <link href="../node_modules/jquery/dist/jquery.js" />
    <script src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="../js/function.js"></script>
    <title>Confirmação de Cadastro</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-faded" style="background-color: #182b3d;">
        <div class="container-fluid" style="padding-bottom: 30px;">
            <a class="navbar-brand" style="color: #f2f2f2; margin-top: 20px;">StreamLine</a>
        </div>
    </nav>
    <div class="flex-box container-box">
        <div class="card-body">
            <h3 class="card-title" style="color:#f2f2f2;">Confirmar Cadastro</h3>
            <p class="card-text" style="min-width: 200px;">
                Digite o código enviado para o seu e-mail.
            </p>
            <form method="post" action="" id="form" name="form" style="color: #f2f2f2;">
                <div class="form-group">
                    <label class="label" for="Token">Código:</label>
                    <input type="text" class="form-control" required name="token" id="token" placeholder="123456" />
                </div>
                <button type="submit" id="btnPress" name="btnPress" class="btnPress" style="margin-top: 10%;">
                    Confirmar Cadastro
                </button>
                <a href="../Home.html"><input type="button" id="btnCancel" class="btnCancel" value="Cancelar" /></a>

            </form>
        </div>
    </div>

</body>

</html>
