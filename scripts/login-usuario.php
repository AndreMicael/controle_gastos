<?php
session_start();
require_once("../config/con_bd.php");

// Verifique se os campos estão definidos
if (isset($_POST["login"], $_POST["entrar"])) {

    $login = $_POST["login"];
    $entrar = $_POST["entrar"];

    // Verifique a conexão
    if (!$conn) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    // Preparar a consulta para evitar SQL Injection
    $stmt = $conn->prepare("SELECT nome FROM usuario WHERE username = ?");
    $stmt->bind_param("s", $login);  // "s" significa string

    // Executar a consulta
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o usuário foi encontrado
    if ($result->num_rows <= 0) {
        echo "<script language='javascript' type='text/javascript'>
        alert('Login incorreto');window.location.href='../login-usuario.html';</script>";
        die();
    } else {
        $row = $result->fetch_assoc();
        $nome = $row['nome']; // Pega o nome do banco de dados

        // Armazena o nome e o login na sessão
        $_SESSION["login"] = $login;
        $_SESSION["nome"] = $nome; // Armazena o nome do usuário na sessão
       

        header("Location:../index.php");
        exit();
    }

    // Fechar a conexão
    $stmt->close();
    mysqli_close($conn);
}
?>
