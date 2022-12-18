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
    $genero = $_POST['genero'];
    $email = $_POST['email_prof'];
    $biografia = $_POST['biografia'];
    $profissao = $_POST['profissao']; 
    $tempo_exp = $_POST['tempo_exp'];
    $esp_exp = $_POST['espTempo'];
    $contato = $_POST['contato'];
    $preco = $_POST['preco_fixo'];
    $espTempo = $_POST['espTempo'];
    $perfil = $_POST['foto_perfil'];
    
    $link = "http://api.whatsapp.com/send?1=pt_BR&phone=55$contato";

    // Foto de Perfil

    $foto_perfil = $_FILES['perfil'] ['name'];
    $foto_tipo = $_FILES['perfil'] ['type'];

    $pasta = "../autonomo/perfil/"; //local onde as imagens armazenam

    $sql = mysqli_query($con,"UPDATE `cadastroprofissional` SET `nome_prof`='$nome',
  `genero`='$genero',`email_prof`='$email',`profissao`='$profissao',
  `tempo_exp`='$tempo_exp',`espTempo`='$espTempo',`esp_exp`='$esp_exp',`biografia`='$biografia',
  `contato`='$contato',`link`='$link',`preco_fixo`='$preco', `foto_perfil`='$foto_perfil'
    WHERE Id_prof = '$id_prof'");

    move_uploaded_file($_FILES['perfil']['tmp_name'], $pasta."/".$foto_perfil); //upload das imagens

    

      if($sql >= 1){
        echo "<script>alert('Registro Atualizado com sucesso!')</script>";
        header('Location: ../autonomo/dadosPublicosAutonomo.php');

      }else{
        echo mysqli_connect_error();
        echo "<script>alert('Erro!');</script>";
      } 

      if ($foto_nula = mysqli_query($con, "SELECT * FROM `cadastroprofissional` WHERE foto_perfil = '' and Id_prof = $id_prof;")) {
        
        $quant_foto = mysqli_num_rows($foto_nula);
        if($quant_foto >= 1){
          $up = mysqli_query($con, "UPDATE `cadastroprofissional` SET `nome_prof`='$nome',
          `genero`='$genero',`email_prof`='$email',`profissao`='$profissao',
          `tempo_exp`='$tempo_exp',`espTempo`='$espTempo',`esp_exp`='$esp_exp',`biografia`='$biografia',
          `contato`='$contato',`link`='$link',`preco_fixo`='$preco', `foto_perfil`='$perfil'
            WHERE Id_prof = '$id_prof'");
            header('Location: ../autonomo/dadosPublicosAutonomo.php');
        }else{
          echo mysqli_connect_error();
        echo "<script>alert('Erro!');</script>";
        } }
  

?>
