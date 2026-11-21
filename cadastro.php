<?php
require_once("funcoes.php");
require_once("conexao.php");
exigir_post();

// Recebe e valida os dados do formulário
$nome      = trim($_POST['nome'] ?? '');
$email     = trim($_POST['email'] ?? '');
$senha     = $_POST['senha'] ?? '';
$confirmar = $_POST['confirmarsenha'] ?? '';

if ($nome === '' || mb_strlen($nome) > 100) {
    die("Informe um nome válido (até 100 caracteres).");
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Informe um e-mail válido.");
}
if (strlen($senha) < 6) {
    die("A senha deve ter pelo menos 6 caracteres.");
}
if ($senha !== $confirmar) {
    die("As senhas não coincidem.");
}

// Criptografa a senha e insere usando prepared statement
$senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nome, $email, $senha_criptografada);

try {
    $stmt->execute();
    header("Location: login.html");
} catch (mysqli_sql_exception $erro) {
    if ($erro->getCode() === 1062) { // e-mail já cadastrado (UNIQUE)
        die("Este e-mail já está cadastrado.");
    }
    error_log("Erro ao cadastrar: " . $erro->getMessage());
    die("Erro ao cadastrar. Tente novamente.");
}
