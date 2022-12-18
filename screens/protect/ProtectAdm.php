<?php

    if(!isset($_SESSION)){

    $adm = "SELECT C.Id_cli, P.Id_prof, C.email_cli, P.email_prof, C.ativo, P.ativo, C.token, P.token 
    FROM cadastrocliente C 
    INNER JOIN cadastroprofissional P ON C.token = P.token
    WHERE P.token = 'a87ff679a2f3e71d9181a67b7542122c' AND C.token = 'a87ff679a2f3e71d9181a67b7542122c'
    AND C.email_cli = 'mailstreamlineserver@gmail.com' AND P.email_prof = 'mailstreamlineserver@gmail.com'
    AND C.ativo = '0' AND P.ativo = '0'";
    $adm_query = $con->query($adm) or die("Falha no SQL: ".$con->error);
    $admSessao = $adm_query->num_rows;

       if($admSessao == 1){
        session_start();
    }else{
        exit();
        header("Location: ../Home.php");
    }
      }

      if(!isset($_SESSION['token'])){
        exit();
        header("Location: ../Home.php");
      }
?>
