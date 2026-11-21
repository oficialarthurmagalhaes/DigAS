<?php
require_once("funcoes.php");
require_once("conexao.php");
exigir_login();
exigir_post();

$nome = trim($_POST['nome'] ?? '');
$nova_senha = $_POST['senha'] ?? '';
$email = $_SESSION['email'];

if ($nome === '' || mb_strlen($nome) > 100) {
    die("Informe um nome válido (até 100 caracteres).");
}

if ($nova_senha !== '') {
    if (strlen($nova_senha) < 6) {
        die("A nova senha deve ter pelo menos 6 caracteres.");
    }
    $senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE usuarios SET nome = ?, senha = ? WHERE email = ?");
    $stmt->bind_param("sss", $nome, $senha_hash, $email);
} else {
    $stmt = $conn->prepare("UPDATE usuarios SET nome = ? WHERE email = ?");
    $stmt->bind_param("ss", $nome, $email);
}

$stmt->execute();
$_SESSION['nome'] = $nome;
header("Location: index.php");
