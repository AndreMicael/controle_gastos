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

    // Puxar entrada e saídas e calcular o balanço
    $entradas = $_SESSION['entradas'];
    $saidas = $_SESSION['saidas'];

    // Combinar entradas e saídas
    $transacoes = [];
    $totalEntradas = 0;
    $totalSaidas = 0;

    // Adicionar entradas ao array de transações
    foreach ($entradas as $key => $entrada) {
        $transacoes[] = [
            'id' => $key, // Supondo que o ID seja a chave da entrada
            'tipo' => 'entrada',
            'descricao' => $entrada['descricao'],
            'valor' => $entrada['valor'],
            'data' => $entrada['data_entrada'],
            'categoria' => $entrada['categoria']
        ];
        $totalEntradas += $entrada['valor'];
    }

    // Adicionar saídas ao array de transações
    foreach ($saidas as $key => $saida) {
        $transacoes[] = [
            'id' => $key, // Supondo que o ID seja a chave da saída
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
                <form action='excluir_transacao.php' method='POST' style='display:inline;'>
                    <input type='hidden' name='id' value='" . htmlspecialchars($transacao['id']) . "'>
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

    ?>
</body>
</html>
