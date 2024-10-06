<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balanço</title>
</head>
<body>
    <?php 
    require_once("config/con_bd.php");
    session_start();

    if (!isset($_SESSION['login'])) {
        header('Location: index.php');
        exit();
    }

    // Obtém o ID do usuário logado
    $user_id = $_SESSION['user_id'];

    // Puxar entradas e saídas do banco de dados
    $entradas_query = "SELECT id, descricao, valor, data_entrada, categoria FROM entradas WHERE usuario_id = '$user_id'";
    $saidas_query = "SELECT id, descricao, valor, data_saida, categoria FROM saidas WHERE usuario_id = '$user_id'";

    $entradas_result = mysqli_query($conn, $entradas_query);
    $saidas_result = mysqli_query($conn, $saidas_query);

    $transacoes = [];
    $totalEntradas = 0;
    $totalSaidas = 0;

    // Adicionar entradas ao array de transações
    while ($entrada = mysqli_fetch_assoc($entradas_result)) {
        $transacoes[] = [
            'id' => $entrada['id'],
            'tipo' => 'entrada',
            'descricao' => $entrada['descricao'],
            'valor' => $entrada['valor'],
            'data' => $entrada['data_entrada'],
            'categoria' => $entrada['categoria']
        ];
        $totalEntradas += $entrada['valor'];
    }

    // Adicionar saídas ao array de transações
    while ($saida = mysqli_fetch_assoc($saidas_result)) {
        $transacoes[] = [
            'id' => $saida['id'],
            'tipo' => 'saida',
            'descricao' => $saida['descricao'],
            'valor' => $saida['valor'],
            'data' => $saida['data_saida'],
            'categoria' => $saida['categoria']
        ];
        $totalSaidas += $saida['valor'];
    }

    // Ordenar transações por data
    usort($transacoes, function($a, $b) {
        return strtotime($a['data']) - strtotime($b['data']);
    });

    // Exibir a tabela
    echo "<table border='1'>
            <tr>
                <th>Tipo</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Data</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>";

    foreach ($transacoes as $transacao) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars(ucfirst($transacao['tipo'])) . "</td>"; 
        echo "<td>" . htmlspecialchars($transacao['descricao']) . "</td>"; 
        echo ($transacao['tipo'] === 'entrada') ? "<td> R$ " . htmlspecialchars($transacao['valor']) . "</td>" : "<td> -R$ " . htmlspecialchars($transacao['valor']) . "</td>";

        $data = new DateTime($transacao['data']);
        echo "<td>" . htmlspecialchars($data->format('d/m/Y')) . "</td>";
        echo "<td>" . htmlspecialchars($transacao['categoria']) . "</td>";   
        
        // Adicionando o botão de excluir
        echo "<td>
                <form action='scripts/excluir-transacao.php' method='POST' style='display:inline;'>
                    <input type='hidden' name='id' value='" . htmlspecialchars($transacao['id']) . "'>
                    <input type='hidden' name='tipo' value='" . htmlspecialchars($transacao['tipo']) . "'>
                    <input type='submit' value='Excluir' onclick='return confirm(\"Tem certeza que deseja excluir esta transação?\");'>
                </form>
              </td>";

        echo "</tr>";
    }

    $totalBalanco = $totalEntradas - $totalSaidas;

    echo "<tr>
            <td colspan='4'>Balanço</td>
            <td>R$ " . number_format($totalBalanco, 2, ',', '.') . "</td>        
        </tr>";

    echo "</table>";

    echo "<a href='criar-entrada.php'>Inserir Nova Entrada</a>";
    echo "<a href='criar-saida.php'>Inserir Nova Saída</a>";

    // Fechar conexão com o banco de dados
    mysqli_close($conn);
    ?>
</body>
</html>
