<!-- Objetivo: Fazer logout do sistema
Quando o usuário clica no botão "Sair" na navbar, ele é redirecionado para a página sair.php.
Nesta página, a sessão é destruída e o usuário é redirecionado para a página de login ou home.
Fluxo de logout: navbar-login.php -> sair.php -> home.php -->

<?php
session_start(); // Inicia a sessão
session_unset(); // Remove todas as variáveis de sessão
session_destroy(); // Destroi a sessão

// Redireciona para a página de login ou home
header("Location: ../index.php");
exit();  
?>
