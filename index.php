<!-- Pagina Home.php. Esta é a página inicial do site. Aqui contem os botões que serã ousados para o usuario 
interagir com o site através de login ou cadastro. -->

<?php  
include('components/navbar.php'); // Inclui a navbar do site (essa navbar aparece apenas para usuários não logados)
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finans | Pagina Inicial</title>
  </head>
  <body>
    <section class='bg-blue-800 text-white h-auto '>
      <div class='flex flex-row justify-center '>
        <div class='  flex flex-col justify-center'>
          <h1 class='text-4xl font-extralight'>Suas contas, descomplicadas.</h1>
          <h2>Esta ferramenta online descomplica seu controle financeiro.</h2>

          <!-- Aqui começa um botão que leva para a página de cadastro. Essa é pra ser a primeira interação do usuário com o site -->
          <!-- caso o usuário já seja cadastrado, ele pode fazer o login no botão do login que está na navbar  -->

          <a href='criar-usuario.php'> 
            <h2>
              <button class="text-white mt-4 hover:text-red-500 bg-red-500 hover:bg-blue-800 border-2 border-red-500 hover:border-2 
              hover:border-white focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 
              dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800"> Cadastre-se <button>
            </h2>
          </a>
        </div>
        <div>
          <img src="components/capa-mulher.png" alt="Capa Site">
        </div>
      </div>
    </section>
  </body>
</html>
<?php
include('components/footer.php'); // Inclui o footer do site
?>