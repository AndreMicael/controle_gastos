<!-- Objetivo: Atualizar uma transação (entrada ou saída) no banco de dados
Quando o usuário clica no botão "Editar" em uma transação na página de entradas ou saídas, ele é redirecionado para a página editar-transacao.php.

Nesta página, o usuário pode editar os dados da transação, como descrição, valor, data e categoria. 

Final do fluxo botão editar -> atualizar-produto.php -> index.php

-->


<?php
require_once "../config/con_bd.php"; // Inclui o script de conexão ao BD
session_start(); // Inicia a sessão para armazenar o nome do usuário e o ID do usuário após o login

// Verificar se o usuário está logado
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit();
}

// Pegar os dados da requisição POST
// Todos os dados necessários para atualizar a transação nas tables 'entradas' ou 'saidas' do BD
$id = $_POST["id"];
$tipo = $_POST["tipo"];
$descricao = $_POST["descricao"];
$valor = $_POST["valor"];
$data_transacao = $_POST["data_transacao"];
$categoria = $_POST["categoria"];
$pagina_origem = $_POST["pagina_origem"];

// Sanitizar os dados
$descricao = mysqli_real_escape_string($conn, $descricao);
$valor = mysqli_real_escape_string($conn, $valor);
$data_transacao = mysqli_real_escape_string($conn, $data_transacao);
$categoria = mysqli_real_escape_string($conn, $categoria);


// Atualizar o produto no banco de dados
// se for entrada, atualizar na tabela 'entradas', se for saída, atualizar na tabela 'saidas'
if ($tipo === "entrada") {

    // Atualizar na tabela 'entradas'
    $query = "UPDATE entradas 
              SET descricao = '$descricao', valor = '$valor', data_transacao = '$data_transacao', categoria = '$categoria'
              WHERE id = '$id'";
} elseif ($tipo === "saida") {
    // Atualizar na tabela 'saidas'
    $query = "UPDATE saidas 
              SET descricao = '$descricao', valor = '$valor', data_transacao = '$data_transacao', categoria = '$categoria'
              WHERE id = '$id'";
} else {
    echo "Tipo de transação inválido.";
    exit();
}

// Executar a query (atualizar o produto)
if (mysqli_query($conn, $query)) {

    if($pagina_origem = 'entradas') {
        header("Location: ../entradas-usuario.php"); // Redireciona para a página de entradas
    } else if($pagina_origem = 'saidas') {
        header("Location: ../saidas-usuario.php"); // Redireciona para a página de saídas
    } else {
        header("Location: ../index.php"); // Redireciona para a página inicial
    }
    
    exit();
} else {
    echo "Erro ao atualizar produto: " . mysqli_error($conn);
    echo "Query: $query"; // Mostra a query que causou o erro
}
?>
