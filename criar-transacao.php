<?php 

require_once("config/con_bd.php");
include('components/navbar-login.php');
?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar entradas</title>
</head>
<body>
    <h1 style="text-align: center;">Criar nova transação</h1>
    <form class='flex flex-col gap-2 w-1/2 mx-auto align-center' action="scripts/cadastro-transacao.php" method="POST"> <!-- Corrigido aqui -->
    
    <label class='text-sm'>Descrição:</label>
    <input type="text" name="descricao" class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' required /> <!-- Adicionei required para garantir que o campo seja preenchido -->
    
    <label class='text-sm'>Preço:</label>
    <input type="text" name="preco" required class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' /> <!-- Adicionei required para garantir que o campo seja preenchido -->
    
    <label class='text-sm'>Data da Entrada:</label>
    <input type="date" name="data_transacao" required class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'/> <!-- Adicionei required para garantir que o campo seja preenchido -->
    
    <label class='text-sm'>Categoria:</label>
    <input type="text" name="categoria" class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' required /> <!-- Adicionei required para garantir que o campo seja preenchido -->
   
    <label class='text-sm'>Transação</label>    
    <select name="tipo" class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' required>
    <option selected disabled>--selecione--</option>
        <option value="entrada">Entrada</option>
        <option value="saida">Saída</option>
    </select>
  
    
    

  
    <button type="submit" class="w-12 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Criar Transação</button>
    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">

</span>
</button>
    </form>
</body>
</html>
