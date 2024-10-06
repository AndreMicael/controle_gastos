<?php
require_once("config/con_bd.php");
include('components/navbar-login.php');

$edit = file_get_contents('components/edit.svg');
$delete = file_get_contents('components/delete.svg');

   // Obtém o ID do usuário da sessão
   $user_id = $_SESSION['user_id'];


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
 
   
    
    // Consulta ao banco de dados para buscar as entradas do usuário
    $query = "SELECT id, descricao, valor, data_transacao, categoria FROM entradas WHERE usuario_id = '$user_id'";
    $result = mysqli_query($conn, $query);

    // Verifica se a consulta retornou resultados
    if (mysqli_num_rows($result) > 0) {
       
        echo " <div class='mt-6 relative overflow-hidden shadow-md sm:rounded-lg w-1/2 mx-auto p-4'>
                <table class='w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400'>
                <thead class='text-xs text-gray-600  bg-gray-50 dark:bg-gray-700 dark:text-gray-400'>
                <tr>
                    <th scope='col' class='px-6 py-3'>Descrição</th>
                    <th scope='col' class='px-6 py-3'>Valor</th>
                    <th scope='col' class='px-6 py-3'>Data</th>
                    <th scope='col' class='px-6 py-3'>Categoria</th>
                   <th scope='col' class='px-6 py-3' colspan='2'></th>
                    
                </tr>
                </thead>";
        
        // Itera sobre os resultados e exibe as entradas
        while ($entrada = mysqli_fetch_assoc($result)) {
            echo "<tbody>";
            echo "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'>";
            echo "<td class='px-6 py-3'>" . htmlspecialchars($entrada['descricao']) . "</td>"; 
            echo "<td class='px-6 py-3'>R$ " . htmlspecialchars($entrada['valor']) . "</td>";

            $data = new DateTime($entrada['data_transacao']);
            echo "<td class='px-6 py-3'>" . htmlspecialchars($data->format('d/m/Y')) . "</td>";
            
            echo "<td class='px-6 py-3'>" . htmlspecialchars($entrada['categoria']) . "</td>";

            echo "<td class='px-6 py-3'>
            <form action='scripts/excluir-transacao.php' method='POST' style='display:inline;'>
                 <input type='hidden' name='id' value='" . htmlspecialchars($entrada['id']) . "'>
                 <input type='hidden' name='tipo' value='entrada'>
                <button type='submit' value='Excluir' onclick='return confirm(\"Tem certeza que deseja excluir esta transação?\");'> $delete </button>
            </form>


          </td>";

            echo "<td class='px-6 py-3'>
            <form action='editar-transacao.php' method='POST' style='display:inline;'>
                <input type='hidden' name='id' value='" . htmlspecialchars($entrada['id']) . "'>
                 <input type='hidden' name='tipo' value='entrada'>
                 <button type='submit' value='Editar'> $edit </button>
            </form>

            
            </td>";
                
            echo "</tr>";
        }
        
        echo "</tbody> </table></div>";
        
    } else {
        echo "Nenhuma entrada encontrada.";
    }
    ?>
</body>
 
<?php include('components/footer.php'); ?>
</html>

