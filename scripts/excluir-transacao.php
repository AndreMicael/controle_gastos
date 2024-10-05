<?php 

session_start();
require_once("../config/con_bd.php");

if (!isset($_SESSION['login'])) {
    header('Location: ../index.php');
    exit(); // Adicionado exit() para garantir que o script pare após redirecionar
}


?>