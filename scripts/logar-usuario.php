<!-- Esse script realiza a verificação do login do usuário. Ele é chamado quando o usuário clica no botão de login na página de login.
Ele verifica se o usuário existe no banco de dados e se a senha está correta. Se o login for bem-sucedido, o usuário é redirecionado 
para a página inicial do site. Caso contrário, uma mensagem de erro é exibida. 

Aqui continua (segundo estágio) o fluxo: login-usuario.php -> scripts/logar-usuario.php -> index.php

-->

<?php
session_start(); // Inicia a sessão para armazenar o nome do usuário e o ID do usuário após o login
require_once "../config/con_bd.php"; // Inclui o script de conexão ao BD

// Verifique se os campos login, senha e entrar estão definidos
if (isset($_POST["login"], $_POST["entrar"], $_POST["senha"])) {
    $login = $_POST["login"];
    $entrar = $_POST["entrar"];
    $senha = $_POST["senha"];

    // Verifica se existe uma conexão com o banco de dados
    if (!$conn) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    // Preparar a consulta para evitar SQL Injection
    $stmt = $conn->prepare(
        "SELECT id, nome, senha FROM usuario WHERE username = ?"
    );
    // Substitui o ? pelo valor do login
    // "s" significa string
    // O login é o nome de usuário que o usuário inseriu no formulário de login
    $stmt->bind_param("s", $login); 


    // Executar a consulta
    // A consulta é executada e o resultado é armazenado em $result
    // O resultado é um conjunto de linhas que correspondem ao nome de usuário inserido
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o usuário foi encontrado
    // Se o número de linhas no resultado for menor ou igual a 0, o usuário não foi encontrado
    // Se o usuário não foi encontrado, exibe uma mensagem de erro e redireciona o usuário para a página de login
    if ($result->num_rows <= 0) {
        echo "<script language='javascript' type='text/javascript'>
        alert('Login incorreto');window.location.href='../login-usuario.html';</script>"; //Alert para informar que o login está incorreto
        die();
    } else {
        // Se o usuário foi encontrado, pega o nome, a senha e o ID do usuário
        $row = $result->fetch_assoc(); // Pega a linha do resultado
        $nome = $row["nome"]; // Pega o nome do banco de dados
        $senhaBD = $row["senha"]; // Pega a senha do banco de dados
        $userId = $row["id"]; // Pega o ID do usuário

        // Verifique se a senha está correta
        if ($senha === $senhaBD) {           
            // Armazena o nome, login e user_id na sessão
            // A sessão é usada para armazenar informações do usuário, como nome, login e ID do usuário
            $_SESSION["login"] = $login; // Armazena o login do usuário na sessão
            $_SESSION["nome"] = $nome; // Armazena o nome do usuário na sessão, vamos usar isso no index.php
            $_SESSION["user_id"] = $userId; // Armazena o ID do usuário na sessão como user_id, importante para a identificação do usuário no BD

            // Redireciona o usuário para a página inicial do site, lá ele vai ver o balanço geral das finanças dele
            header("Location:../index.php");
            exit();
        } else {
            // Se a senha estiver incorreta, exibe uma mensagem de erro e redireciona o usuário para a página de login
            echo "<script language='javascript' type='text/javascript'>
            alert('Senha incorreta');window.location.href='../login-usuario.php';</script>"; //Alert para informar que a senha está incorreta
            die();
        }
    }

    // Fechar a conexão
    $stmt->close();
    mysqli_close($conn);
}
?>
