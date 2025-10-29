<?php

$usuario_correto = 'adm';
$senha_correta = 'sesi'; 

$usuario_digitado = $_POST['usuario'] ?? '';
$senha_digitada = $_POST['senha'] ?? '';

if ($usuario_digitado === $usuario_correto && $senha_digitada === $senha_correta) {
} else {
    echo '<!DOCTYPE html>
    <html lang="pt-br">
    <head><meta charset="UTF-8"><title>Acesso Negado</title>
    <style>
        body{font-family: Arial, sans-serif; text-align: center; margin-top: 50px; background-color: #f4f7f9; color: #333;}
        .error{color: #dc3545; font-size: 2em;}
        .voltar{display: inline-block; margin-top: 20px; padding: 10px 15px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;}
        .voltar:hover{background-color: #0056b3;}
    </style>
    </head>
    <body>
    <h1 class="error">ACESSO NEGADO</h1>
    <p>Usuário ou senha incorretos. Você não tem permissão para acessar esta página.</p>
    <a href="index.html" class="voltar">Voltar para a página inicial</a>
    </body>
    </html>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Comentários</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f9;
            color: #333;
            padding: 20px;
        }

        h1 {
            color: #007bff;
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
        }

        
        table {
           
            width: 90%; 
            border-collapse: collapse; 
            margin-top: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            white-space: pre-wrap; 
        }

        th {
            background-color: #007bff;
            color: white;
        }

        td:nth-child(1) {
            width: 15%; 
            font-weight: bold;
        }
        
        tr:nth-child(even) {
            background-color: #f2f2f2; 
        }

        .voltar { 
            display: inline-block; 
            margin-bottom: 15px; 
            padding: 10px 15px; 
            background-color: #6c757d; 
            color: white; 
            text-decoration: none; 
            border-radius: 5px; 
            transition: background-color 0.3s; 
        }
        .voltar:hover { 
            background-color: #5a6268; 
        }
    </style>
</head>
<body>
    <h1>Comentários e Países Cadastrados</h1>
    <a href="index.html" class="voltar">Voltar ao Formulário</a>
    <?php 

    $servidor = "localhost";
    $usuario = "root"; 
    $senha = ""; 
    $banco = "onu"; 

    $conexao = new mysqli($servidor, $usuario, $senha, $banco);


    if ($conexao->connect_error) {
        die("<p style='color: red;'>Erro de Conexão com o Banco de Dados: " . $conexao->connect_error . "</p>");
    }

    
    $sql = "SELECT comentario, pais FROM onu"; 
    $resultado = $conexao->query($sql);

    if ($resultado->num_rows > 0) {
        // Iniciar a tabela HTML
        echo "<table>";
        echo "<thead><tr><th>País</th><th>Comentário</th></tr></thead>";
        echo "<tbody>";

        // Iterar sobre cada linha de resultado (registro)
        while($linha = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($linha["pais"]) . "</td>";
            // Usa nl2br para preservar quebras de linha e htmlspecialchars para segurança
            echo "<td>" . nl2br(htmlspecialchars($linha["comentario"])) . "</td>"; 
            echo "</tr>";
        }

        // Fechar a tabela HTML
        echo "</tbody></table>";
    } else {
        echo "<p>Nenhum comentário cadastrado ainda.</p>";
    }

    // 5. FECHAR CONEXÃO
    $conexao->close();
    ?>
</body>
</html>
