<?php
require_once("config/con_bd.php");

session_start();
if (!isset($_SESSION['login'])) {
    header('Location: index.php');
    exit(); // Adicionado exit() para garantir que o script pare após redirecionar
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entradas</title>
</head>
<body>
    <?php 
    // Verifica se há entradas armazenadas na sessão
    if (!empty($_SESSION['saidas'])) {
        echo "<a href='criar-entrada.php'>Inserir Nova Saída</a>";
        echo "<a href='entradas-usuario.php'>Ir para Entradas</a>";
        echo "<table border='1'>
                <tr>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Data</th>
                    <th>Categoria</th>
                </tr>";
        
        // Exibir as entradas armazenadas na sessão
        foreach ($_SESSION['saidas'] as $saidas) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($saidas['descricao']) . "</td>"; 
            echo "<td>" . htmlspecialchars($saidas['valor']) . "</td>";
            echo "<td>" . htmlspecialchars($saidas['data_saida']) . "</td>";
            echo "<td>" . htmlspecialchars($saidas['categoria']) . "</td>";
            echo "</tr>";
        }
    
        echo "</table>";
    } else {
        echo "Nenhuma saida armazenada na sessão.";
    }
    ?>
</body>
</html>


