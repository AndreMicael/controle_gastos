<?php
require_once("config/con_bd.php");
include('components/navbar-login.php');


// Verificar se o usuário está logado
if (!isset($_SESSION['login'])) {
    header('Location: index.php');
    exit();
}

$id = $_POST['id'];
$tipo = $_POST['tipo'];

// Sanitizar os dados
$id = mysqli_real_escape_string($conn, $id);
$tipo = mysqli_real_escape_string($conn, $tipo);

if($tipo === 'entrada'){
    $query = "SELECT descricao, valor, data_transacao, categoria FROM entradas WHERE id = '$id'";
    $edit_entrada = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($edit_entrada) > 0) {
        $produto = mysqli_fetch_assoc($edit_entrada);
    } else {
        echo "<br />Erro: entrada não encontrada.";
        exit();
    }
} elseif ($tipo === 'saida') {
    // Deletar da tabela 'saidas'
    $query = "SELECT descricao, valor, data_transacao, categoria FROM saidas WHERE id = '$id'";
    $edit_saida = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($edit_saida) > 0) {
        $produto = mysqli_fetch_assoc($edit_saida);
    } else {
        echo "<br />Erro: saída não encontrada.";
        exit();
    }
} else {
    // Se o tipo da transação for inválido
    echo "Tipo de transação inválido.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
</head>
<body>
   
    <form action="scripts/atualizar-produto.php" class='flex flex-col   w-1/2 mt-6 mx-auto align-center' method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="tipo" value="<?php echo $tipo; ?>">
        <label for="descricao" class='text-sm'>Descrição:</label>
        <input type="text" name="descricao" class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' value="<?php echo htmlspecialchars($produto['descricao']); ?>" required><br>

        <label class='text-sm' for="valor">Valor:</label>
        <input type="number" step="0.01" name="valor" class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' value="<?php echo htmlspecialchars($produto['valor']); ?>" required><br>

        <label for="data_entrada" class='text-sm'>Data da transação:</label>
        <input type="date" name="data_transacao" class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' value="<?php echo htmlspecialchars($produto['data_transacao']); ?>" required><br>

        <label  class='text-sm' for="categoria">Categoria:</label>
        <input type="text" name="categoria"  class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'  value="<?php echo htmlspecialchars($produto['categoria']); ?>" required><br>

        

        <button type="submit" value="Salvar"  class=" w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" onclick='return confirm("Tem certeza que deseja editar esta transação?");'> Salvar </button>
    </form>
</body>
</html>
