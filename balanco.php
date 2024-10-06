<?php 
    require_once("config/con_bd.php");
    include('components/navbar-login.php');
    $edit = file_get_contents('components/edit.svg');
    $delete = file_get_contents('components/delete.svg');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balanço</title>
</head>
<body>
<h1 style="text-align: center;">Balanço Geral</h1>
    <?php 

    

    if (!isset($_SESSION['login'])) {
        header('Location: index.php');
        exit();
    }
    
    // Obtém o ID do usuário logado
    $user_id = $_SESSION['user_id'];

    // Puxar entradas e saídas do banco de dados
    $entradas_query = "SELECT id, descricao, valor, data_transacao, categoria FROM entradas WHERE usuario_id = '$user_id'";
    $saidas_query = "SELECT id, descricao, valor, data_transacao, categoria FROM saidas WHERE usuario_id = '$user_id'";

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
            'data' => $entrada['data_transacao'],
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
            'data' => $saida['data_transacao'],
            'categoria' => $saida['categoria']
        ];
        $totalSaidas += $saida['valor'];
    }

    // Ordenar transações por data
    usort($transacoes, function($a, $b) {
        return strtotime($a['data']) - strtotime($b['data']);
    });

    // Exibir a tabela
    echo "  <div class='relative overflow-hidden shadow-md sm:rounded-lg w-1/2 mx-auto p-4'>
            <table class='w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400'>
            <thead class='text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400'>
            <tr>
                <th scope='col' class='px-6 py-3'>Tipo</th>
                <th scope='col' class='px-6 py-3'>Descrição</th>
                <th scope='col' class='px-6 py-3'>Valor</th>
                <th scope='col' class='px-6 py-3'>Data</th>
                <th scope='col' class='px-6 py-3'>Categoria</th>
                <th scope='col' colspan='2' class='px-6 py-3'></th>
               
            </tr>
             </thead>";

    foreach ($transacoes as $transacao) {
        echo "<tbody>";
        echo "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'>";
        echo "<td class='px-6 py-3'>" . htmlspecialchars(ucfirst($transacao['tipo'])) . "</td>"; 
        echo "<td class='px-6 py-3'>" . htmlspecialchars($transacao['descricao']) . "</td>"; 
        echo ($transacao['tipo'] === 'entrada') ? "<td> R$ " . htmlspecialchars($transacao['valor']) . "</td>" : "<td> -R$ " . htmlspecialchars($transacao['valor']) . "</td>";

        $data = new DateTime($transacao['data']);
        echo "<td class='px-6 py-3'>" . htmlspecialchars($data->format('d/m/Y')) . "</td>";
        echo "<td class='px-6 py-3'>" . htmlspecialchars($transacao['categoria']) . "</td>";   
        
        // Adicionando o botão de excluir e editar
        echo "<td class='px-6 py-3'>
                <form action='scripts/excluir-transacao.php' method='POST' >
                    <input type='hidden' name='id' value='" . htmlspecialchars($transacao['id']) . "'>
                    <input type='hidden' name='tipo' value='" . htmlspecialchars($transacao['tipo']) . "'>
                    <button class='font-medium text-red-600 dark:text-red-500 hover:underline' type='submit' value='Excluir' onclick='return confirm(\"Tem certeza que deseja excluir esta transação?\");'> $delete </button> 
                </form> 


              </td>";

        echo "<td class='px-6 py-3'>
            <form action='editar-transacao.php' method='POST'>
                <input type='hidden' name='id' value='" . htmlspecialchars($transacao['id']) . "'>
                <input type='hidden' name='tipo' value='" . htmlspecialchars($transacao['tipo']) . "'>
                <button class='font-medium text-blue-600 dark:text-blue-500 hover:underline' type='submit' value='Editar'> $edit </button>
            </form>
    </td>";
          
        

        echo "</tr>";
    }

    $totalBalanco = $totalEntradas - $totalSaidas;

    echo "<tr class='bg-blue-500 text-white '>
            <td class='p-4 '>Balanço</td>
            <td colspan='6' class='font-bold'>R$ " . number_format($totalBalanco, 2, ',', '.') . "</td>        
        </tr>
        </tbody>";

    echo "</table></div>";

    echo "<a href='criar-transacao.php'>Inserir Nova Transacao</a>";
 

    // Fechar conexão com o banco de dados
    mysqli_close($conn);
    ?>
</body>
</html>
