<?php
//sair da sessão (LOGIN)

session_start();
if (isset($_SESSION)) {
    session_destroy();
    header("Location: ../Home.html");
}
?>