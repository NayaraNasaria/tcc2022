<?php 
    $host = "localhost";
    $usuario = "root";
    $senha = ""; 
    $bd = "streamline";
    $con = mysqli_connect($host , $usuario, $senha , $bd);
 ?>

<?php
session_start();

$id_prof = $_SESSION['Id_prof'];

    $nome = $_POST['nome_prof']; 
    $email = $_POST['email_prof'];
    $cep = $_POST['cep'];
    $senha = $_POST['senha'];
    $numero_casa = $_POST['numero_casa'];
    $complemento = $_POST['complemento'];

    if(empty($senha)){
      $sql = mysqli_query($con,"UPDATE `cadastroprofissional` SET `nome_prof`='$nome',`email_prof`='$email',
        `cep`='$cep',`numero_casa`='$numero_casa',`complemento`='$complemento' WHERE Id_prof = '$id_prof'");

          if($sql >= 1){
            echo "<script>alert('Registro Atualizado com sucesso!')</script>";
            header('Location: ../autonomo/dadosPessoaisAutonomo.php');

          }else{
            echo mysqli_connect_error();
            echo "<script>alert('Erro!');</script>";
      }
    }else{
      $novasenha = password_hash($senha, PASSWORD_DEFAULT);

      $updateSenha = mysqli_query($con,"UPDATE `cadastroprofissional` SET `nome_prof`='$nome',`email_prof`='$email',
       `senha`='$novasenha', `cep`='$cep',`numero_casa`='$numero_casa',`complemento`='$complemento' WHERE Id_prof = '$id_prof'");

          if($updateSenha >= 1){
            echo "<script>alert('Registro Atualizado com sucesso!')</script>";
            header('Location: ../autonomo/dadosPessoaisAutonomo.php');

          }else{
            echo mysqli_connect_error();
            echo "<script>alert('Erro!');</script>"; }
    }

    

?>
