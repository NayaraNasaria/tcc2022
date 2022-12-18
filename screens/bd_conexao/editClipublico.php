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
$genero = $_POST['genero'];
$email = $_POST ['email'];
$senha = $_POST ['senha'];
$data_nasc = $_POST ['dataNascimento'];
$data_cadCli = date('Y-m-d');
$tel = $_POST ['telefone'];
$cep = $_POST ['cep'];
$num_casa = $_POST ['num_casa'];
$comp = $_POST ['complemento'];
$cidade = $_POST ['cidade'];
$estado = $_POST ['estado'];
$bio = $_POST['biografia'];
$perfil = $_POST['foto_perfil'];

    $link = "http://api.whatsapp.com/send?1=pt_BR&phone=55$tel";

    // Foto de Perfil
    $foto_perfil = $_FILES['perfil'] ['name'];
    $foto_tipo = $_FILES['perfil'] ['type'];

    $pasta = "../cliente/perfil/"; //local onde as imagens armazenam

    $sql = mysqli_query($con,"UPDATE `cadastrocliente` SET `nome_cli`='$nome',`genero`='$genero',`email_cli`='$email',
    `contato`='$tel', `biografia`='$bio',`link`='$link', `foto_perfil`='$foto_perfil' WHERE Id_cli = $id_cli");

    move_uploaded_file($_FILES['perfil']['tmp_name'], $pasta."/".$foto_perfil); //upload das imagens
    

if($sql >= 1){
  echo "<script>alert('Registro Atualizado com sucesso!')</script>";
  header('Location: ../cliente/dadosPublicosClientes.php');

}else{
  echo mysqli_connect_error();
  echo "<script>alert('Erro!');</script>";
}

if ($foto_nula = mysqli_query($con, "SELECT * FROM `cadastrocliente` WHERE foto_perfil = '' and Id_cli = $id_cli;")) {
        
  $quant_foto = mysqli_num_rows($foto_nula);
  if($quant_foto >= 1){
    $up = mysqli_query($con, "UPDATE `cadastrocliente` SET `nome_cli`='$nome',`genero`='$genero',`email_cli`='$email',`contato`='$tel',
    `biografia`='$bio',`link`='$link', `foto_perfil`='$perfil' WHERE Id_cli = $id_cli");
      header('Location: ../cliente/dadosPublicosClientes.php');
  }else{
    echo mysqli_connect_error();
  echo "<script>alert('Erro!');</script>";
  } }

?>