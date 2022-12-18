<?php

    if(!isset($_SESSION)){
        session_start();
      }

      if(!isset($_SESSION['Id_prof'])){
          exit();
          header("Location: ../autonomo/loginAutonomo.php");
      }
?>