<?php
session_start(); // Inicia a sessão
session_unset(); // Remove todas as variáveis de sessão
session_destroy(); // Destroi a sessão

// Redireciona para a página de login ou home
header("Location: ../home.php");
exit(); // Para garantir que o script não continue executando
?>
