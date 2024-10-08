<!-- Objetivo: Criar uma nova transação (entrada ou saída) no banco de dados
Quando o usuário clica no botão "Adicionar nova transação" na página de entradas, saídas ou na home.php, 
ele é redirecionado para a página criar-transacao.php. 

Nesta página, o usuário pode preencher um formulário com os dados da nova transação, como descrição, valor, data e categoria e tipo de transação. 

Aqui tem um formulário bem simples, este formulário se repete na página de editar-transacao.php.

Fluxo de criação de nova transação: criar-transação.php -> cadastro-transacao.php -> home.php
-->

<?php

require_once "config/con_bd.php"; // Inclui o script de conexão ao BD
include "components/navbar-login.php"; // Inclui a navbar do site (essa navbar aparece apenas para usuários logados)

// Verifica se o usuário está logado
// Se o usuário não estiver logado, redireciona para a página de login
if (!isset($_SESSION["login"])) {
    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar nova transação</title>
</head>
<body class='bg-gray-100'>
   
    <form class='flex flex-col gap-2 w-1/2 mt-6 mx-auto align-center' action="scripts/cadastro-transacao.php" method="POST"> <!-- Corrigido aqui -->
    
    <label class='text-sm'>Descrição:</label>
    <input type="text" name="descricao" class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
     focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
      dark:focus:border-blue-500' required /> 
 
    
    <label class='text-sm'>Preço:</label>
    <input type="text" name="preco" required class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
     focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
     dark:focus:border-blue-500' /> 
  
    
    <label class='text-sm'>Data da transação:</label>
    <input type="date" name="data_transacao" required class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
     focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
      dark:focus:border-blue-500'/> 
    
    
    <label class='text-sm'>Categoria:</label>
    <input type="text" name="categoria" class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
     focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
      dark:focus:border-blue-500' required /> 
 
   
    <label class='text-sm'>Transação:</label>    
    <select name="tipo" class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500
     p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' required>
    <option selected disabled>--selecione--</option>
        <option value="entrada">Entrada</option>
        <option value="saida">Saída</option>
    </select>
    
    <button type="submit" class=" w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 
    font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none
     dark:focus:ring-blue-800">Criar Transação</button>
    
</span>
</button>
    </form>
    <?php include "components/footer.php"; ?>
    <!-- Adicionado o footer.php para incluir o rodapé do site -->
</body>
</html>
