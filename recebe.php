<?php
    $comentario = $_POST['comentario'];
    $pais = $_POST['pais'];

    $host = 'https://onu2025.vercel.app';
    $db = 'onu';
    $user = 'root';
    $password = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    try{
        $pdo = new PDO(dsn: $dsn, username: $user, password: $password);
        header("Location: sucesso.html");
    }catch(\PDOExecption $e){
        throw new \PDOExecption(message: $e->getMessage()). code;
        (int)$e->getcode();
    }

    $sql = "INSERT INTO onu (comentario, pais) VALUES(?,?)";

    $stmt = $pdo->prepare(query: $sql);

    $stmt->execute(params: [$comentario, $pais]);
?>
