<?php
session_start();
include('../bd_conexao/conexao.php');

$id_prof = $_SESSION['Id_prof'];
$cliente = $_POST['cliente'];
$nomecliente = $_POST['nome'];
$data_aval = date('Y-m-d');
$comentario = $_POST['comentario'];
$aval = $_POST['estrela'];

if(!empty($_POST['estrela'])){
    $estrela = $_POST['estrela'];

    //QUEM AVALIOU FOI O AUTONOMO
$sql = mysqli_query ($con, "UPDATE `avaliacoescliente` SET `nome_cli`='$nomecliente',`data_aval_cli`='$data_aval',
`Comentario_cli`='$comentario',`Avaliacao_cli`='$aval' WHERE Id_prof = $id_prof");


if($sql >= 1){
  $data_atual = date('Y-m-d');
  date_default_timezone_set('America/Sao_Paulo'); //converter para horário de Brasília
  $horario_atual = date('H:i:s', time());
   
  $update = mysqli_query($con, "UPDATE `servico` SET `data_finalizacao`= '$data_atual' 
  WHERE Id_prof = $id_prof and Id_cli = $cliente");
  
  if ($update >= 1) {
    $delete = mysqli_query($con, "DELETE FROM `orcamento` WHERE Id_prof = $id_prof");
    header('Location: ../autonomo/InicialAutonomoTrabPendentes.php');
    echo "<script>alert('Serviço Finalizado!');</script>";
  } else {
    echo "<script>alert('Não foi Possível Finalizar o Serviço!
                        \nPor favor, avalie!');</script>";
    header('Location: ../autonomo/AvaliacaoCliente.php');
  }
}else{
    echo "<script>alert('Não foi possível avaliar!');</script>";
    header('Location: ../autonomo/AvaliacaoCliente.php');

}

} else{
    $_SESSION['msg'] = "Necessário Avaliar!";
    header('Location: ../autonomo/AvaliacaoCliente.php');
}

?>
