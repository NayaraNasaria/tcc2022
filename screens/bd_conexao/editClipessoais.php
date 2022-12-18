<?php 
    $host = "localhost";
    $usuario = "root";
    $senha = ""; 
    $bd = "streamline";
    $con = mysqli_connect($host , $usuario, $senha , $bd);
 ?>

<?php
session_start();
$id_cli = $_SESSION['Id_cli'];

$nome = $_POST['nome']; 
$email = $_POST ['email'];
$senha = $_POST ['senha'];
$cep = $_POST ['cep'];
$num_casa = $_POST ['numero_casa'];
$comp = $_POST ['complemento'];
$cidade = $_POST ['cidade'];
$estado = $_POST ['estado'];

if(empty($senha)){ 
        $sql = mysqli_query($con,"UPDATE `cadastrocliente` SET `nome_cli`='$nome',`email_cli`='$email',
       `cep`='$cep',`numero_casa`='$num_casa',`complemento`='$comp', `cidade`='$cidade', `estado`='$estado' WHERE Id_cli = '$id_cli'");

      if($sql >= 1){
        echo "<script>alert('Registro Atualizado com sucesso!')</script>";
        header('Location: ../cliente/dadosPessoaisClientes.php');

      }else{
        echo mysqli_connect_error();
        echo "<script>alert('Erro!');</script>";
      }

}else{
         $novasenha = password_hash($senha, PASSWORD_DEFAULT);

         $updateSenha = mysqli_query($con,"UPDATE `cadastrocliente` SET `nome_cli`='$nome',`email_cli`='$email',
        `senha`='$novasenha',`cep`='$cep',`numero_casa`='$num_casa',`complemento`='$comp', `cidade`='$cidade', `estado`='$estado' WHERE Id_cli = '$id_cli'");

        if($updateSenha >= 1){
          echo "<script>alert('Registro Atualizado com sucesso!')</script>";
          header('Location: ../cliente/dadosPessoaisClientes.php');

        }else{
          echo mysqli_connect_error();
          echo "<script>alert('Erro!');</script>";
}
}



?>
