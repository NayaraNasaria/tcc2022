<?php
session_start();
include('../bd_conexao/conexao.php');

$id_cli = $_SESSION['Id_cli'];
$id_prof = $_POST['autonomo'];
$nome_cli = $_POST['nome_cli'];
$data_aval = date('Y-m-d');
$comentario = $_POST['comentario'];
$aval = $_POST['estrela'];

if(!empty($_POST['estrela'])){
    $estrela = $_POST['estrela'];

    $sql = mysqli_query ($con, "UPDATE `avaliacoesprofissional` SET `nome_cli`='$nome_cli',
    `data_aval_prof`='$data_aval', `Comentario_prof`='$comentario',`Avaliacao_prof`='$aval' 
    WHERE Id_cli = $id_cli");


if($sql >= 1){
    $update = mysqli_query($con, "UPDATE `servico` SET  `hora_finalizacao`='$horario_atual'
    WHERE Id_prof = '$id_prof' AND Id_cli ='$cliente'");

    if ($update >= 1) {
        echo "<script>alert('Serviço Finalizado!');</script>";
        header('Location: ../cliente/InicialClientesTrabPendentes.php');
      } else {
        echo "<script>alert('Não foi Possível Finalizar o Serviço!
                            \nPor favor, avalie!');</script>";
        header('Location: ../cliente/AvaliacaoAutonomo.php');
      }
}else{
    echo "<script>alert('Não foi possível avaliar!');</script>";
    header('Location: ../cliente/AvaliacaoAutonomo.php');
}

} else{
    $_SESSION['msg'] = "Necessário Avaliar!";
    header('Location: ../cliente/AvaliacaoAutonomo.php');
}

?>