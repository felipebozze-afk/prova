<?php
$host = "localhost";
$banco = "empresa_db";
$usuario = "root";
$senha = "";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$banco;charset=utf8mb4",
        $usuario,
        $senha,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );
} catch (PDOException $erro) {
    die("Erro ao conectar ao banco de dados. Confira config/conexao.php e importe banco.sql. Detalhe: " . $erro->getMessage());
}
