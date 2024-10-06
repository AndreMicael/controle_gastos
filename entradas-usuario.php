<?php
require_once("config/con_bd.php");
include('components/navbar-login.php');


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
<h1 style="text-align: center;">Entradas</h1>
    <?php 
    // Obtém o ID do usuário da sessão
    $user_id = $_SESSION['user_id'];
   
    
    // Consulta ao banco de dados para buscar as entradas do usuário
    $query = "SELECT id, descricao, valor, data_transacao, categoria FROM entradas WHERE usuario_id = '$user_id'";
    $result = mysqli_query($conn, $query);

    // Verifica se a consulta retornou resultados
    if (mysqli_num_rows($result) > 0) {
       
        echo "<table border='1'>
                <tr>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Data</th>
                    <th>Categoria</th>
                    <th>Excluir</th>
                    <th>Editar</th>
                </tr>";
        
        // Itera sobre os resultados e exibe as entradas
        while ($entrada = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($entrada['descricao']) . "</td>"; 
            echo "<td>" . htmlspecialchars($entrada['valor']) . "</td>";

            $data = new DateTime($entrada['data_transacao']);
            echo "<td>" . htmlspecialchars($data->format('d/m/Y')) . "</td>";
            
            echo "<td>" . htmlspecialchars($entrada['categoria']) . "</td>";

            echo "<td>
            <form action='scripts/excluir-transacao.php' method='POST' style='display:inline;'>
                <input type='hidden' name='id' value='" . htmlspecialchars($entrada['id']) . "'>
                 <input type='hidden' name='tipo' value='entrada'>
                <input type='submit' value='Excluir' onclick='return confirm(\"Tem certeza que deseja excluir esta transação?\");'>
            </form>


          </td>";

            echo "<td>
            <form action='editar-transacao.php' method='POST' style='display:inline;'>
                <input type='hidden' name='id' value='" . htmlspecialchars($entrada['id']) . "'>
                 <input type='hidden' name='tipo' value='entrada'>
                <input type='submit' value='Editar'>
            </form>

            
            </td>";
                
            echo "</tr>";
        }
    
        echo "</table>";
        
    } else {
        echo "Nenhuma entrada encontrada.";
    }
    ?>
</body>
</html>
