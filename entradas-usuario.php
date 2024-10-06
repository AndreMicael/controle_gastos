<!-- Essa página serve para exibir apenas as entradas do usuário 
Vamos consultar a table entradas no banco de dados e exibir as entradas do usuário logado

Aqui vamos exibir as entradas do usuário logado. Para isso, vamos consultar a tabela
entradas no banco de dados e exibir as entradas do usuário logado.

Além disso é possível excluir e editar as transações

Interações possíveis: Ver entradas, Editar entradas, Excluir entradas, Criar nova transação
Também é possivel ver a soma total das entradas
-->


<?php
require_once "config/con_bd.php"; // Inclui o script de conexão ao BD
include "components/navbar-login.php"; // Inclui a navbar do site (essa navbar aparece apenas para usuários logados)

// Edit e Delete são ícones que serão usados para estilizar os botões de editar e deletar transações.
$edit = file_get_contents("components/edit.svg");
$delete = file_get_contents("components/delete.svg");

// $user_id é o ID do usuário logado que será usado para buscar as saídas no banco de dados, recuperado da sessão 
$user_id = $_SESSION["user_id"];

// Verifica se o usuário está logado
// Se o usuário não estiver logado, redireciona para a página de login
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit();  
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
    // Puxar entradas do banco de dados
    // Aqui fazemos a query para pegar as entradas do usuário logado, a query vem da table "entradas" do BD    
    $query = "SELECT id, descricao, valor, data_transacao, categoria FROM entradas WHERE usuario_id = '$user_id'";

    // Executar a query
    $result = mysqli_query($conn, $query);

    // Variavel para armazenar o total de entradas
    $total_entradas = 0;

    //  Verifica se a consulta retornou resultados
    if ($result && mysqli_num_rows($result) > 0) {
        echo " <div class='mt-6 relative overflow-hidden shadow-md sm:rounded-lg w-1/2 mx-auto p-4'>
                <table class='w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400'>
                <thead class='text-xs text-gray-600  bg-gray-50 dark:bg-gray-700 dark:text-gray-400'>
                <tr>
                    <th scope='col' class='px-3 py-3'>Descrição</th>
                    <th scope='col' class='px-3 py-3'>Valor</th>
                    <th scope='col' class='px-3 py-3'>Data</th>
                    <th scope='col' class='px-3 py-3'>Categoria</th>
                   <th scope='col' class='px-3 py-3' colspan='2'></th>
                    
                </tr>
                </thead>";

        // Exibir as entradas do usuário
        // Aqui exibimos as entradas do usuário logado
        // A função mysqli_fetch_assoc() retorna uma linha do conjunto de resultados como um array associativo
        // O htmlspecialchars() foi explicado anteriormente na pagina index.php
        // o DateTime() também foi explicado anteriormente na página index.php
        // Laço while para percorrer todas as entradas do usuário
        while ($entrada = mysqli_fetch_assoc($result)) {
            echo "<tbody>";
            echo "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'>";
            
            echo "<td class='px-3 py-3'>" .
                htmlspecialchars($entrada["descricao"]) .
                "</td>";
            echo "<td class='px-3 py-3'>R$ " .
                htmlspecialchars($entrada["valor"]) .
                "</td>";

            // Soma o valor da entrada ao total de entradas
            $total_entradas += $entrada["valor"];

            $data = new DateTime($entrada["data_transacao"]);
            echo "<td class='px-3 py-3'>" .
                htmlspecialchars($data->format("d/m/Y")) .
                "</td>";

            echo "<td class='px-3 py-3'>" .
                htmlspecialchars($entrada["categoria"]) .
                "</td>";

            echo "<td class='px-3 py-3'>
            <form action='scripts/excluir-transacao.php' method='POST' style='display:inline;'>
                 <input type='hidden' name='pagina_origem' value='entradas'>         
                 <input type='hidden' name='id' value='" .
                htmlspecialchars($entrada["id"]) .
                "'>
                 <input type='hidden' name='tipo' value='entrada'>
                <button type='submit' value='Excluir' onclick='return confirm(\"Tem certeza que deseja excluir esta transação?\");'> $delete </button>
            </form>


          </td>";

            echo "<td class='px-6 py-3'>
            <form action='editar-transacao.php' method='POST' style='display:inline;'>
            <input type='hidden' name='pagina_origem' value='entradas'>  
                <input type='hidden' name='id' value='" .
                htmlspecialchars($entrada["id"]) .
                "'>
                 <input type='hidden' name='tipo' value='entrada'>
                 <button type='submit' value='Editar'> $edit </button>
            </form>

            
            </td>";

            echo "</tr>";
        }

        echo "<tr class='bg-green-500 text-white'>
        <td class='p-4'>Total Entradas:</td>
        <td colspan='6' class='font-bold'>R$ " . number_format($total_entradas, 2, ',', '.') . "</td>        
      </tr>";

        echo "</tbody> </table></div>";
    } else {
        echo "<div class='mt-4 mx-auto  text-center'>";
        echo "Nenhuma entrada encontrada.";
        echo "<div class='mb-4'> <a href='criar-transacao.php' class='text-blue-600 dark:text-blue-500 hover:underline'> Adicionar nova transação </a> </div>";
        echo "</div>";
    }
    ?>
</body>
 
<?php include "components/footer.php"; ?>
<!-- Aqui adicionamos o footer  -->
</html>

