<?php

    if(!isset($_SESSION)){
        session_start();
      }

      if(!isset($_SESSION['Id_cli'])){
        exit();
        header("Location: ../cliente/loginCliente.php");
      }
?>