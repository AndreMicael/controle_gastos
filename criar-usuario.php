<?php 

require_once("config/con_bd.php");

?>


<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>
</head>
<body>
    <form action="scripts/cadastro-usuario.php" method="POST">
    
    <label>Nome:</label>
	<input type="text" name="nome" />
	<br />
	<label>Sobrenome:</label>
	<input type="text" name="sobrenome" />
	<br />
	<br />
	<label>Username:</label>
	<input type="text" name="username" />
	<br />
	<br />
	<label>Senha:</label>
	<input type="text" name="senha" />
	<br />
	<button type="submit">
		Cadastrar
	</button>


    </form>
</body>
</html>