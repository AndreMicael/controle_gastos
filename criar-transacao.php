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
    
    <button type="submit">
        Adicionar Transacao
    </button>

    </form>
</body>
</html>
