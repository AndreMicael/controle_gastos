<!-- Está página serve para criar um novo usuário no sistema. Aqui capturaremos os dados necessários para a o cadastro no 
nosso banco de dados, que são: nome, sobrenome, nome de usuário e senha. Esses dados serão enviados para o script 
cadastro-usuario.php, que fará a inserção no banco de dados. 

Caso o usuário já tenha cadastro, ele pode acessar a página de 
login clicando no link "Já tem cadastro? Faça Login". 

 Nesta página começa o fluxo: criar-usuario.php -> cadastro-usuario.php -->


<?php include('components/navbar.php'); // Inclui a navbar do site (essa navbar aparece apenas para usuários não logados) ?>


<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>
  </head>
  <body>
    <section class="mt-6 w-1/2 mx-auto dark:bg-gray-900">
      <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white"> Cadastre-se </h1>

            <!-- Aqui começa o formulario de cadastro de usuário. O usuário deve preencher os campos com as 
            informações solicitadas para que possa ser cadastrado no site.
            O que for inserido no form, vai ser enviado para o banco de dados, usando o arquivo cadastro-usuario.php. -->

            <!-- Dados a ser inseridos:
            * Primeiro nome
            * Sobrenome
            * Nome de Usuário
            * Senha -->

            <form action="scripts/cadastro-usuario.php" method="POST">
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Primeiro nome:</label>
              <input class='bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block 
              w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 
              dark:focus:border-blue-500' type="text" name="nome" />
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sobrenome:</label>
              <input class='bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block
               w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 
               dark:focus:border-blue-500' type="text" name="sobrenome" />
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome de Usuário:</label>
              <input class='bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block 
              w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 
              dark:focus:border-blue-500' type="text" name="username" />
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senha:</label>
              <input class='bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block 
              w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 
              dark:focus:border-blue-500' type="password" name="senha" />
              <button class=" w-full mb-4 mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg 
              text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="submit"> Cadastrar </button>
              
              <!-- Botão para redirecionar para a página de login, caso o usuário já tenha cadastro. -->               
              <a class='hover:underline  ' href="login-usuario.php">Já tem cadastro? Faça Login</a>
            </form>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>