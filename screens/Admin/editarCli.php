<?php
session_start();
include('../bd_conexao/conexao.php');
include('../protect/ProtectAdm.php');

 if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $sql = mysqli_query($con,"SELECT  Id_cli, ativo FROM cadastrocliente WHERE Id_cli = $id");
    
        if($sql->num_rows > 0){
            while($dados = mysqli_fetch_assoc($sql)){
            $id = $dados['Id_cli'];
            $ativo = $dados['ativo'];
        }
        }
}
else{
    header("Location: telaAdm.php");
}

            if (isset($_POST['editar'])) { 
                $valorativo = $_POST['ativo'];
                $update = mysqli_query($con,"UPDATE `cadastrocliente` SET ativo ='$valorativo' WHERE Id_cli = $id");

                if($update >= 1){
                  header('Location: telaAdm.php?cliente=cliente&filtro=filtro');
          
                }else{
                  echo mysqli_connect_error();
                  echo "<script>alert('Não foi possível editar!');</script>";
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
  <link rel="stylesheet" href="../../css/bodyContract.css" />
  <link rel="stylesheet" href="../../css/navbar.css" />
  <link href="../../node_modules/jquery/dist/jquery.js" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
  <script src="../../node_modules/bootstrap/dist/js/bootstrap.js"></script>
  <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="../../js/function.js"></script>
  <title>Editar - Administrador</title>
</head>

<body>
<nav class="navbar navbar-expand-lg bg-faded" style="background-color: #f2f2f2;">
    <div class="container-fluid">
      <a class="navbar-brand">StreamLine</a>
      <button class="navbar-toggler first-button" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <div class="animated-icon1">
          <span></span><span></span><span></span><span></span>
        </div>
      </button>
    </div>
  </nav>
  <br>
  <br>
  <br>
  <div class="container"> 
            <a class="btn btn-dark" href='telaAdm.php'>Voltar</a>
            
            <form action="#" method="POST" onsubmit="return validarFormulario()" name="edit" id="edit">
            <br>
            <div class="form-row align-items-center">
                <div class="col-sm-3 my-1">
                <label class="sr-only" for="id">ID</label>
                <input type="text" class="form-control" id="id" name="id" value="<?php echo $id?>" placeholder="ID" readonly>
                </div>
                <div class="col-sm-3 my-1">
                <label class="sr-only" for="ativo">Ativo</label>
                    <input type="text" class="form-control" name="ativo" value="<?php echo $ativo?>"  id="ativo" placeholder="1">
                </div>
                </div>
                
                <div class="col-auto my-1">
                <button type="submit" name="editar" class="btn btn-success">Concluir</button>
                </div>
            </div>
            </form>
</div>

<script>
    function validarFormulario(){
        var ativoInativo = document.forms["edit"]["ativo"].value;
        if (ativoInativo > 1) {
            alert("Valor 1 (Ativo)\nValor 0 (Inativo)\nNão são aceitos valores maiores do que 1.");
            return false;     
        }
        else{
            alert("Edição realizada com sucesso!");
            return true;
        }
    }
</script>
</body>