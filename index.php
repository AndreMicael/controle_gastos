<!-- Esta é a primeira página que o usuário vai ver ao logar no site.

Nesta página, o usuário pode ver suas últimas transações,
editar ou excluir transações e criar novas transações.

Além disso pode interagir com navbar e navegar pelo site, vendo entradas, saídas e balanço geral.

O usuário só pode ver suas próprias transações, pois o ID do usuário é armazenado na sessão ao fazer login.
Se o usuário não estiver logado, ele será redirecionado para a página de login.


Aqui finalizamos o fluxo login-usuario.php -> scripts/logar-usuario.php -> index.php

-->

<?php
require_once "config/con_bd.php"; // Inclui o script de conexão ao BD
include "components/navbar-login.php"; // Inclui a navbar do site (essa navbar aparece apenas para usuários logados)

// Edit e Delete são ícones que serão usados para estilizar os botões de editar e deletar transações.
$edit = file_get_contents("components/edit.svg");
$delete = file_get_contents("components/delete.svg");

// Verifica se o nome do usuário está definido na sessão
// Salvamos o nome da sessão ao fazer login	e vamos exibir aqui para deixar mais personalizado.
// O nome vai aparecer tanto na página inicial quanto no título da página (aba do navegador ao lado do favicon)
$nome_session = $_SESSION["nome"] ?? null;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Aqui colocamos o nome do usuário logado na aba do navegador -->
    <title> <?php echo $nome_session ?>  | Página Inicial</title>     
</head>
<body>

<?php

// Verifica se o nome do usuário está definido na sessão
if (isset($nome_session)) {
    echo "<h1 class='text-center mt-6 font-bold'> Bem-Vindo, $nome_session</h1> ";
    echo "<h2 class='text-center '>Aqui estão suas últimas transações</h2> ";

    // Obtém o ID do usuário logado, o id é importante para identificar as transações do usuário no BD
    $user_id = $_SESSION["user_id"];

    // Puxar entradas e saídas do banco de dados
    // Aqui fazemos as querys para pegar as entradas e saídas do usuário logado, as querys vem das tables "entradas" e "saídas" do BD
    $entradas_query = "SELECT id, descricao, valor, data_transacao, categoria FROM entradas WHERE usuario_id = '$user_id'";
    $saidas_query = "SELECT id, descricao, valor, data_transacao, categoria FROM saidas WHERE usuario_id = '$user_id'";

    // Executar as querys
    $entradas_result = mysqli_query($conn, $entradas_query);
    $saidas_result = mysqli_query($conn, $saidas_query);

    // Aqui criamos o array de transações, onde vamos armazenar todas as transações do usuário
    // Precisamos desse array para juntar as entradas e saídas no mesmo lugar e assim conseguir fazer a subtração para o balanço e ordenar também.
    $transacoes = [];

    // totalEntradas e totalSaidas são variáveis que vão armazenar o valor total das entradas e saídas do usuário.
    $totalEntradas = 0;
    $totalSaidas = 0;
    

    // Adicionar entradas ao array de transações
    while ($entrada = mysqli_fetch_assoc($entradas_result)) {
        $transacoes[] = [
            "id" => $entrada["id"],
            "tipo" => "entrada",
            "descricao" => $entrada["descricao"],
            "valor" => $entrada["valor"],
            "data" => $entrada["data_transacao"],
            "categoria" => $entrada["categoria"],
        ];
        // Soma o valor da entrada ao total de entradas
        $totalEntradas += $entrada["valor"];
    }

    // Adicionar saídas ao array de transações
    while ($saida = mysqli_fetch_assoc($saidas_result)) {
        $transacoes[] = [
            "id" => $saida["id"],
            "tipo" => "saida",
            "descricao" => $saida["descricao"],
            "valor" => $saida["valor"],
            "data" => $saida["data_transacao"],
            "categoria" => $saida["categoria"],
        ];
        // Somar o valor da saída ao total de saídas
        $totalSaidas += $saida["valor"];
    }

    // Ordenar transações por data
    usort($transacoes, function ($a, $b) {
        return strtotime($b["data"]) - strtotime($a["data"]);
    });

    // Exibir a tabela
    // Aqui começa a tabela que vai exibir as transações do usuário, com as colunas: Tipo, Descrição, Valor, Data, Categoria, Editar e Excluir.
    echo "<div class=' mt-6 relative overflow-hidden shadow-md sm:rounded-lg w-1/2 mx-auto p-4'>
            <table class='w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400'>
                <thead class='text-xs text-gray-600 bg-gray-50 dark:bg-gray-700 dark:text-gray-400'>
                    <tr>
                        <th scope='col' class='px-6 py-3'>Tipo</th>
                        <th scope='col' class='px-6 py-3'>Descrição</th>
                        <th scope='col' class='px-6 py-3'>Valor</th>
                        <th scope='col' class='px-6 py-3'>Data</th>
                        <th scope='col' class='px-6 py-3'>Categoria</th>
                        <th scope='col' colspan='2' class='px-2 py-3'></th>
                    </tr>
                </thead>";

    // foreach para percorrer o array de transações e exibir cada transação na tabela
    // A função htmlspecialchars() torna o código mais seguro e previne a entrada de caracteres especiais. 
    // Esta função converte caracteres especiais para a realidade HTML.
    // https://www.linhadecomando.com/php/php-htmlspecialchars

    // Para trabalhar com a data, usamos a classe DateTime do PHP
    // Eu queria exibir a data no padrão brasileiro, que é DD/MM/AAAA
    // primeiro eu instanciei um objeto DateTime recebendo a data da transação
    // depois usei o método format para formatar a data no padrão que eu queria  
    foreach ($transacoes as $transacao) {
        echo "<tbody>";
        echo "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'>";
        echo "<td class='px-6 py-3'>" .
            htmlspecialchars(ucfirst($transacao["tipo"])) .
            "</td>";
        echo "<td class='px-6 py-3'>" .
            htmlspecialchars($transacao["descricao"]) .
            "</td>";
        echo $transacao["tipo"] === "entrada"
            ? "<td> R$ " . htmlspecialchars($transacao["valor"]) . "</td>"
            : "<td> -R$ " . htmlspecialchars($transacao["valor"]) . "</td>";

        $data = new DateTime($transacao["data"]);
        echo "<td class='px-6 py-3'>" .
            htmlspecialchars($data->format("d/m/Y")) .
            "</td>";
        echo "<td class='px-6 py-3'>" .
            htmlspecialchars($transacao["categoria"]) .
            "</td>";

        // BOTÃO DE EXCLUIR TRANSAÇÃO
        echo "<td class='px-2 py-3'>
                <form action='scripts/excluir-transacao.php' method='POST'>
                    <input type='hidden' name='id' value='" .
            htmlspecialchars($transacao["id"]) .
            "'>
                    <input type='hidden' name='tipo' value='" .
            htmlspecialchars($transacao["tipo"]) .
            "'>
                    <button class='font-medium text-red-600 dark:text-red-500 hover:underline' type='submit' value='Excluir' onclick='return confirm(\"Tem certeza que deseja excluir esta transação?\");'> $delete </button>
                </form>
              </td>";
        // BOTÃO DE EDITAR TRANSAÇÃO
        echo "<td class='px-2 py-3'>
                <form action='editar-transacao.php' method='POST'>
                    <input type='hidden' name='id' value='" .
            htmlspecialchars($transacao["id"]) .
            "'>
                    <input type='hidden' name='tipo' value='" .
            htmlspecialchars($transacao["tipo"]) .
            "'>
                    <button class='font-medium text-blue-600 dark:text-blue-500 hover:underline' type='submit' value='Editar'> $edit </button>
                </form>
              </td>";
        echo "</tr>";
    }

    // Exibir o total de entradas, saídas e balanço
    // $totalBalanço é a diferença entre o total de entradas e o total de saídas
    // Exibimos balanço na tabela e no final temos um botão para criar nova transação
    $totalBalanco = $totalEntradas - $totalSaidas;

    echo "<tr class='bg-green-500 text-white'>
            <td class='p-4'>Balanço</td>
            <td colspan='6' class='font-bold'>R$ " .
        number_format($totalBalanco, 2, ",", ".") .
        "</td>        
          </tr>
          </tbody>";

    echo "</table>";

    echo "<a href='criar-transacao.php'><button type='button' class='mt-4 mx-auto  w-full text-white bg-blue-700 hover:bg-blue-800 
    focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 
    focus:outline-none dark:focus:ring-blue-800'>Criar nova transação</button></a></div>";

    // Fechar conexão com o banco de dados
    mysqli_close($conn);
} else {
    echo '<link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />';
    echo '<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>';
    echo "<div class='mx-auto'>";
    echo "Essas informações NÃO PODEM ser acessadas por você. </br>";
    echo "<a class='hover:underline font-bold text-red-500' href='login-usuario.php'>Faça login</a>";
    echo " ou ";
    echo "<a  class='hover:underline font-bold text-red-500' href='criar-usuario.php'>cadastre-se</a>";
    echo "</div>";
}
?>
<?php include "components/footer.php"; ?> 
<!-- Adicionar o footer ao final da página -->

</body>
</html>
