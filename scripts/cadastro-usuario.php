<?php

// Neste script, estamos cadastrando um novo usuário no banco de dados. O usuário deve preencher os campos com as informações
// solicitadas para que possa ser cadastrado no site. O que for inserido no formulário, será enviado para o
// banco de dados. Os dados aqui tratados vieram do formulário de cadastro de usuário, que está na página criar-usuario.php.

// Final do fluxo: criar-usuario.php -> cadastro-usuario.php

require_once "../config/con_bd.php"; //Inclui o script de conexão ao BD

if ($conn != null) {
	// Verifica se os campos do formulário de cadastro de usuário estão preenchidos
    if (
        !empty($_POST["nome"]) &&
        !empty($_POST["sobrenome"]) &&
        !empty($_POST["username"]) &&
        !empty($_POST["senha"])
    ) {
        // Sanitizando os dados de entrada
        $nome_usuario = mysqli_real_escape_string($conn, $_POST["nome"]);
        $sobrenome_usuario = mysqli_real_escape_string(
            $conn,
            $_POST["sobrenome"]
        );
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $senha = mysqli_real_escape_string($conn, $_POST["senha"]);


		// Inserindo os dados no BD
        $str_insert = "INSERT INTO usuario (nome,sobrenome,username,senha) 
							 VALUES ('$nome_usuario','$sobrenome_usuario','$username','$senha')";
		
		// Executando a query
        $result = mysqli_query($conn, $str_insert);

		// Verifica se a query foi executada com sucesso
        if ($result) {
            echo "<br />Novo usuario cadastrado com sucesso!";
			header ("Location: ../login-usuario.php"); // Redireciona para a página de login
        } else {
            echo "<br />Erro cadastrando usuario!";
            echo "<br />ERRO: " . mysqli_error($conn); //exibir o erro retornado pelo SGBD
            echo "<br />ERRO n.: " . mysqli_errno($conn); //exibir o número do erro retornado pelo SGBD
        }
    } else {
		// Caso algum campo esteja vazio
        echo "<br />Usuario não cadastrado!
				  <br />Preencha todos os campos!";
    }
} else {
	// Caso não seja possível conectar ao BD
    echo "<br />Não foi possível realizar o cadastro do usuario no momento!";
    echo "<br />ERROR: " . $error_conn_db;
}

?>
