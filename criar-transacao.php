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
    <form action="scripts/cadastro-transacao.php" method="POST"> <!-- Corrigido aqui -->
    
    <label>Descrição:</label>
    <input type="text" name="descricao" required /> <!-- Adicionei required para garantir que o campo seja preenchido -->
    <br />
    <label>Preço:</label>
    <input type="text" name="preco" required /> <!-- Adicionei required para garantir que o campo seja preenchido -->
    <br />
    <label>Data da Entrada:</label>
    <input type="date" name="data_transacao" required /> <!-- Adicionei required para garantir que o campo seja preenchido -->
    <br />
    <label>Categoria:</label>
    <input type="text" name="categoria" required /> <!-- Adicionei required para garantir que o campo seja preenchido -->
    <label>Transação</label>
    <select name="tipo" required>
        <option value="entrada">Entrada</option>
        <option value="saida">Saída</option>
    </select>
    <br />
    
    

    <button type="submit" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
Criar Transação
</span>
</button>
    </form>
</body>
</html>
