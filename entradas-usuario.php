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
    // Obtém o ID do usuário da sessão
    $user_id = $_SESSION['user_id'];
    
    // Consulta ao banco de dados para buscar as entradas do usuário
    $query = "SELECT id, descricao, valor, data_entrada, categoria FROM entradas WHERE usuario_id = '$user_id'";
    $result = mysqli_query($conn, $query);

    // Verifica se a consulta retornou resultados
    if (mysqli_num_rows($result) > 0) {
        echo "<a href='criar-entrada.php'>Inserir Nova Entrada</a>";
        echo "<a href='saidas-usuario.php'>Ir para Saídas</a>";
        echo "<table border='1'>
                <tr>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Data</th>
                    <th>Categoria</th>
                </tr>";
        
        // Itera sobre os resultados e exibe as entradas
        while ($entrada = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($entrada['descricao']) . "</td>"; 
            echo "<td>" . htmlspecialchars($entrada['valor']) . "</td>";

            $data = new DateTime($entrada['data_entrada']);
            echo "<td>" . htmlspecialchars($data->format('d/m/Y')) . "</td>";
            
            echo "<td>" . htmlspecialchars($entrada['categoria']) . "</td>";
            echo "</tr>";
        }
    
        echo "</table>";
        
    } else {
        echo "Nenhuma entrada encontrada.";
    }
    ?>
</body>
</html>
