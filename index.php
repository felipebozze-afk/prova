<?php
session_start();
require_once __DIR__ . "/config/conexao.php";
require_once __DIR__ . "/models/Funcionario.php";
require_once __DIR__ . "/models/FuncionarioComum.php";
require_once __DIR__ . "/models/Gerente.php";
require_once __DIR__ . "/controllers/FuncionarioController.php";

$controller = new FuncionarioController($pdo);

if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["acao"] ?? "") === "iniciar_sessao") {
    $nomeOperador = trim($_POST["operador"] ?? "");
    if ($nomeOperador !== "") {
        $_SESSION["operador"] = $nomeOperador;
        $_SESSION["mensagem"] = "Bem-vindo(a), " . $nomeOperador . "!";
    } else {
        $_SESSION["mensagem"] = "Informe o nome do operador.";
    }
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["acao"] ?? "") === "encerrar_sessao") {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["acao"] ?? "") === "cadastrar") {
    $resultado = $controller->cadastrar($_POST);
    $_SESSION["mensagem"] = $resultado["mensagem"];
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["acao"] ?? "") === "excluir") {
    $resultado = $controller->excluir((int)($_POST["id"] ?? 0));
    $_SESSION["mensagem"] = $resultado["mensagem"];
    header("Location: index.php");
    exit;
}

$mensagem = $_SESSION["mensagem"] ?? "";
unset($_SESSION["mensagem"]);

$funcionarios = $controller->listar();
$excluirId = isset($_GET["excluir"]) ? filter_var($_GET["excluir"], FILTER_VALIDATE_INT) : false;
$funcionarioExcluir = $excluirId ? $controller->buscar($excluirId) : null;
require_once __DIR__ . "/views/index.php";
