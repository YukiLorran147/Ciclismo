<?php
// processar_cadastro.php

// Recebe os dados via POST
$nome = $_POST['nome'] ?? '';
$cpf = $_POST['cpf'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$genero = $_POST['genero'] ?? '';
$data_nascimento = $_POST['data_nascimento'] ?? '';
$tamanho_camisa = $_POST['tamanho_camisa'] ?? '';

// Validações básicas (pode aprimorar conforme necessidade)
if (
    !empty($nome) &&
    preg_match('/^[a-zA-ZÀ-ÿ\s\'-]+$/u', $nome) &&
    preg_match('/^\d{11}$/', $cpf) &&
    preg_match('/^\d{11}$/', $telefone) &&
    in_array($genero, ['feminino', 'masculino', 'outro']) &&
    !empty($data_nascimento) &&
    in_array($tamanho_camisa, ['pp', 'p', 'm', 'g', 'gg'])
) {
    // Aqui você pode salvar os dados no banco, se quiser

    // Redireciona para a tela de login sem botão cadastrar
    header('Location: login_sem_cadastrar.html');
    exit();
} else {
    // Dados inválidos, redireciona para o formulário (pode enviar mensagem de erro)
    header('Location: cadastro.html?erro=1');
    exit();
}
?>
