<!-- Nesta página realizmos o login do usuário, isso fará ele ter acesso aos serviços e dados do site e do bd.
O usuário precisa ter um username uma senha para poder acessar o site.

Aqui é o primeiro estágio do fluxo: login-usuario.php -> scripts/logar-usuario.php -> home.php (página inicial logada) 
 -->

<?php 
include('components/navbar.php'); // Inclui a navbar do site (essa navbar aparece apenas para usuários não logados)
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Entrar</title>
  </head>
  <body>
    <section class="mt-6 w-1/2 mx-auto dark:bg-gray-900">
      <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white"> Entre com a sua conta </h1>

            <!-- Aqui começa o formulário de login do usuário. 
            Solicitamos o username e a senha do usuário para que ele possa acessar a sua conta. -->

            <!-- Dados a serem inseridos:
            * Nome de Usuário
            * Senha -->            

            <form method="POST" class=" md:space-y-6" action="scripts/logar-usuario.php">
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="login">Nome de usuário:</label>
              <input class='bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' type="text" name="login" id="login" required>
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="senha">Senha:</label>
              <input class='bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' type="password" name="senha" id="senha" required>
              <input class=" w-full mb-4 mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="submit" value="Entrar" id="entrar" name="entrar">
              
            <!-- Botão para redirecionar para a página de cadastro, caso o usuário ainda não tenha cadastro. -->
              <a class='hover:underline  ' href="criar-usuario.php">Novo por aqui? Cadastre-se</a>
            </form>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>