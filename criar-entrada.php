<?php 

require_once("config/con_bd.php");

?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar entradas</title>
</head>
<body>
    <form action="scripts/cadastro-entrada.php" method="POST"> <!-- Corrigido aqui -->
    
    <label>Descrição:</label>
    <input type="text" name="descricao" required /> <!-- Adicionei required para garantir que o campo seja preenchido -->
    <br />
    <label>Preço:</label>
    <input type="text" name="preco" required /> <!-- Adicionei required para garantir que o campo seja preenchido -->
    <br />
    <label>Data da Entrada:</label>
    <input type="date" name="data_entrada" required /> <!-- Adicionei required para garantir que o campo seja preenchido -->
    <br />
    <label>Categoria:</label>
    <input type="text" name="categoria" required /> <!-- Adicionei required para garantir que o campo seja preenchido -->
    <br />
    
    <button type="submit">
        Adicionar Entrada
    </button>

    </form>
</body>
</html>
