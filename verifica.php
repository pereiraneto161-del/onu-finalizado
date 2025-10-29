<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Comentários</title>
    <link rel="stylesheet" href="v.css">
</head>
<body>

    <h1>Comentários e Países Cadastrados</h1>

    <a href="index.html" class="voltar">Voltar ao Formulário</a>
    
    <?php
    // 1. CONFIGURAÇÃO DO BANCO DE DADOS
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "onu";

    // 2. TENTAR CONEXÃO
    $conexao = new mysqli($servidor, $usuario, $senha, $banco);

    // Checar conexão
    if ($conexao->connect_error) {
        die("<p style='color: red;'>Erro de Conexão com o Banco de Dados: " . $conexao->connect_error . "</p>");
    }

    // 3. QUERY PARA SELECIONAR OS DADOS
    // REMOVIDO: id da seleção SQL
    $sql = "SELECT comentario, pais FROM onu"; // Ordena pelo ID de forma decrescente para mostrar o mais recente primeiro
    $resultado = $conexao->query($sql);

    // 4. VERIFICAR SE EXISTEM RESULTADOS
    if ($resultado->num_rows > 0) {
        // Iniciar a tabela HTML
        echo "<table>";
        // REMOVIDO: Coluna ID do cabeçalho da tabela
        echo "<thead><tr><th>País</th><th>Comentário</th></tr></thead>";
        echo "<tbody>";

        // Iterar sobre cada linha de resultado (registro)
        while($linha = $resultado->fetch_assoc()) {
            echo "<tr>";
            // REMOVIDO: Exibição do $linha["id"]
            echo "<td>" . htmlspecialchars($linha["pais"]) . "</td>";
            // Usa nl2br para preservar quebras de linha e htmlspecialchars para segurança
            echo "<td>" . nl2br(htmlspecialchars($linha["comentario"])) . "</td>"; 
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";

    } else {
        echo "<p>Nenhum comentário encontrado no banco de dados.</p>";
    }

    // 5. FECHAR CONEXÃO
    $conexao->close();
    ?>

</body>
</html>
