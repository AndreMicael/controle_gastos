<?php

	require_once("../config/con_bd.php");
	
	if ($conn != null) {
	
		if (!empty($_POST['nome']) && !empty($_POST['sobrenome'])) {
		
			//sanitizar dados
			$nome_usuario = 
			  mysqli_real_escape_string($conn, $_POST['nome']);
			$sobrenome_usuario =  
			  mysqli_real_escape_string($conn,$_POST['sobrenome']);
			  
			
			
			$str_insert = "INSERT INTO usuario (nome,sobrenome) 
							 VALUES ('$nome_usuario','$sobrenome_usuario')";
			
			$result = mysqli_query($conn, $str_insert);
			
			if ($result) {
				echo "<br />Novo usuario cadastrado com sucesso!";
			}
			else {
				echo "<br />Erro cadastrando usuario!";
				echo "<br />ERRO: ".mysqli_error($conn); //exibir o erro retornado pelo SGBD
				echo "<br />ERRO n.: ".mysqli_errno($conn); //exibir o número do erro retornado pelo SGBD
			}
		
		}
		else {
			echo "<br />Usuario não cadastrado!
				  <br />Preencha todos os campos!";
			
		}
	}
	else {
		echo "<br />Não foi possível realizar o cadastro do usuario no momento!";
		echo "<br />ERROR: ".$error_conn_db;
	}	

?>