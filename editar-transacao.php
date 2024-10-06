<?php
require_once("config/con_bd.php");
session_start();

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
    $query = "SELECT descricao, valor, data_entrada, categoria FROM entradas WHERE id = '$id'";
    $edit_entrada = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($edit_entrada) > 0) {
        $produto = mysqli_fetch_assoc($edit_entrada);
    } else {
        echo "<br />Erro: entrada não encontrada.";
        exit();
    }
} elseif ($tipo === 'saida') {
    // Deletar da tabela 'saidas'
    $query = "SELECT descricao, valor, data_saida, categoria FROM saidas WHERE id = '$id'";
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
    <h1>Editar Produto</h1>
    <form action="scripts/atualizar-produto.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="tipo" value="<?php echo $tipo; ?>">
        <label for="descricao">Descrição:</label>
        <input type="text" name="descricao" value="<?php echo htmlspecialchars($produto['descricao']); ?>" required><br>

        <label for="valor">Valor:</label>
        <input type="number" step="0.01" name="valor" value="<?php echo htmlspecialchars($produto['valor']); ?>" required><br>

        <label for="data_entrada">Data:</label>
        <?php if($tipo === 'entrada') { ?>
            <input type="date" name="data_entrada" value="<?php echo htmlspecialchars($produto['data_entrada']); ?>" required><br>
        <?php } elseif ($tipo === 'saida') { ?>
            <input type="date" name="data_saida" value="<?php echo htmlspecialchars($produto['data_saida']); ?>" required><br>
        <?php } ?>

        <label for="categoria">Categoria:</label>
        <input type="text" name="categoria" value="<?php echo htmlspecialchars($produto['categoria']); ?>" required><br>

        <input type="submit" value="Salvar" onclick='return confirm("Tem certeza que deseja editar esta transação?");'>
    </form>
</body>
</html>
