<?php
require_once "config.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"]);
    $cpf = trim($_POST["cpf"]);
    $telefone = trim($_POST["telefone"]);
    $genero = isset($_POST["genero"]) ? trim($_POST["genero"]) : null;
    $divisao = trim($_POST["divisao"]);
    $tamanho_camisa = trim($_POST["tamanho_camisa"]);

    $sql = "INSERT INTO usuarios
        (nome, cpf, telefone, genero, divisao, tamanho_camisa)
        VALUES (?, ?, ?, ?, ?, ?)";

    try {
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "ssssss",
            $nome,
            $cpf,
            $telefone,
            $genero,
            $divisao,
            $tamanho_camisa
        );
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conexao);
        header("Location: tela_de_login.html");
        exit;
    } catch (mysqli_sql_exception $e) {
        echo "Erro ao inserir: " . $e->getMessage();
        exit;
    }
}
